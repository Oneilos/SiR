<?php

namespace Sir\Bundle\MajoraNamespaceBundle\Controller;

use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Majora\Bundle\FrameworkExtraBundle\Controller\RestApiController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use SirSdk\Component\MajoraNamespace\Model\MajoraEntity;
use Sir\Bundle\MajoraNamespaceBundle\Form\Type\MajoraEntityType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Api controller for MajoraEntity entity
 *
 * @package majora-namespace-bundle
 * @subpackage controller
 *
 * @RouteResource("MajoraEntity")
 * @NamePrefix("api_rest_")
 */
class MajoraEntityRestApiController extends RestApiController
{
    /**
     * Returns a collection of Orders.
     *
     * @View()
     * @ApiDoc(
     *    description="Returns a collection of MajoraEntitys",
     *    tags={"in-dev"="#FACC2E"},
     *    section="MajoraEntity",
     *    groups={"public"},
     *    output="SirSdk\Component\MajoraNamespace\Model\MajoraEntity",
     *    statusCodes={
     *        200="Returned when successful",
     *        403="If method access denied"
     *    }
     * )
     * @QueryParam(name="ids", strict=false, requirements="([\d+],?)*", description="Comma separated ids to filter on (ie: 42,66)")
     */
    public function cgetAction(ParamFetcherInterface $paramFetcher)
    {
        $ids = $this->parseFilter($paramFetcher->get('ids'));

        $majoraEntityLoader = $this->get('sir.majora_entity.loader');
        switch (true) {
            case !empty($ids):
                $majoraEntityCollection = $majoraEntityLoader->retrieveAll(array('id' => $ids));
                break;

            default:
                $majoraEntityCollection = $majoraEntityLoader->retrieveAll();
        }

        return $this->createJsonResponse(
            $majoraEntityCollection
        );
    }

    /**
     * Returns a single MajoraEntity by id.
     *
     * @View()
     * @ApiDoc(
     *    description="Returns a single MajoraEntity by id",
     *    tags={"in-dev"="#FACC2E"},
     *    section="MajoraEntity",
     *    groups={"public"},
     *    output="SirSdk\Component\MajoraNamespace\Model\MajoraEntity",
     *    requirements={
     *        {"name"="id", "dataType"="integer", "requirement"="\d+", "description"="Requested MajoraEntity id"}
     *    },
     *    statusCodes={
     *        200="Returned when successful",
     *        404="If shop not found",
     *        403="If method access denied"
     *    }
     * )
     */
    public function getAction($id, Request $request)
    {
        return $this->createJsonResponse(
            $this->retrieveOr404($id, 'sir.majora_entity.loader')
        );
    }

    /**
     * @View()
     * @ApiDoc(
     *    description="Create a new MajoraEntity",
     *    tags={"in-dev"="#FACC2E"},
     *    section="MajoraEntity",
     *    groups={"private"},
     *    input="Sir\Bundle\MajoraNamespaceBundle\Form\Type\MajoraEntityType",
     *    output="SirSdk\Component\MajoraNamespace\Model\MajoraEntity",
     *    statusCodes={
     *        201="Returned when successful",
     *        400="If invalid data",
     *        403="If method access denied"
     *    }
     * )
     */
    public function postAction(Request $request)
    {
        $majoraEntity = new MajoraEntity();

        $form = $this->get('form.factory')->create(
            new MajoraEntityType(),
            $majoraEntity
        );

        if (!$this->submitJsonData($request, $form)) {
            return $this->createJsonBadRequestResponse(
                $form->getErrors()
            );
        }

        $this->get('sir.majora_entity.domain')->create($majoraEntity);

        return $this->createJsonResponse(
            $majoraEntity
        );
    }

    /**
     * @View(statusCode=204)
     * @ApiDoc(
     *    description="Update MajoraEntity data for given id",
     *    tags={"in-dev" = "#FACC2E"},
     *    section="MajoraEntity",
     *    groups={"private"},
     *    input="Sir\Bundle\MajoraNamespaceBundle\Form\Type\MajoraEntityType",
     *    requirements={
     *      {"name"="id", "dataType"="integer", "requirement"="\d+", "description"="Requested MajoraEntity id"}
     *    },
     *    statusCodes={
     *      204="Returned when successful",
     *      404="If order not found",
     *      400="If invalid data",
     *      403="If method access denied"
     *    }
     * )
     */
    public function putAction($id, Request $request)
    {
        $majoraEntity = $this->retrieveOr404($id, 'sir.majora_entity.loader');

        $form = $this->get('form.factory')->create(
            new MajoraEntityType(),
            $majoraEntity,
            array('method' => 'PUT')
        );

        if (!$this->submitJsonData($request, $form)) {
            return $this->createJsonBadRequestResponse(
                $form->getErrors()
            );
        }

        $this->get('sir.majora_entity.domain')->update($majoraEntity);

        return $this->createJsonNoContentResponse();
    }

    /**
     * @View()
     * @ApiDoc(
     *    description="Deletes MajoraEntity for given id",
     *    tags={"in-dev"="#FACC2E"},
     *    section="MajoraEntity",
     *    groups={"private"},
     *    requirements={
     *        {"name"="id", "dataType"="integer", "requirement"="\d+", "description"="Requested MajoraEntity id"}
     *    },
     *    statusCodes={
     *        204="Returned when successful",
     *        404="If article not found",
     *        403="If method access denied"
     *    }
     * )
     */
    public function deleteAction($id)
    {
        $majoraEntity = $this->retrieveOr404($id, 'sir.majora_entity.loader');

        $this->get('sir.majora_entity.domain')->delete($majoraEntity);

        return $this->createJsonNoContentResponse();
    }
}
