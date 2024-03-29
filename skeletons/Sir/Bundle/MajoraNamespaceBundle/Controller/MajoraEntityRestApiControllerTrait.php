<?php
/* majora_generator.force_generation: true */

namespace Sir\Bundle\MajoraNamespaceBundle\Controller;

use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Majora\Bundle\FrameworkExtraBundle\Controller\RestApiControllerTrait;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use SirSdk\Component\MajoraNamespace\Model\MajoraEntity;
use Sir\Bundle\MajoraNamespaceBundle\Form\Type\MajoraEntityType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Auto generated controller trait for MajoraEntity entity.
 *
 *
 * @see RestApiControllerTrait::extractQueryFilter(Request $request)
 * @see RestApiControllerTrait::retrieveOr404($entityId, $loaderId)
 * @see RestApiControllerTrait::createRest404($entityId, $loaderId)
 * @see RestApiControllerTrait::createJsonResponse($data = null, $scope = null, $status = 200)
 * @see RestApiControllerTrait::createJsonNoContentResponse()
 * @see RestApiControllerTrait::createJsonBadRequestResponse(array $errors = array())
 * @see RestApiControllerTrait::submitJsonData(Request $request, FormInterface $form)
 * @see RestApiControllerTrait::extractFormData(array $data, FormInterface $form)
 */
trait MajoraEntityRestApiControllerTrait
{
    use RestApiControllerTrait;

    /**
     * Returns a collection of MajoraEntitys.
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
     * @QueryParam(name="scope", strict=false, requirements="\w*", description="Data scope to use on data serialization")
     * @QueryParam(name="limit", strict=false, requirements="\d*", description="Limit of elements returned")
     * @QueryParam(name="offset", strict=false, requirements="\d*", description="Offset in dataset returned")
     */
    public function cgetAction(ParamFetcherInterface $paramFetcher, Request $request)
    {
        return $this->createJsonResponse(
            $this->container->get('sir.majora_entity.loader')->retrieveAll(
                $this->extractQueryFilter($request),
                $paramFetcher->get('limit'),
                $paramFetcher->get('offset')
            ),
            $paramFetcher->get('scope')
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

        $form = $this->container->get('form.factory')->create(
            new MajoraEntityType(),
            $majoraEntity
        );

        if (!$this->submitJsonData($request, $form)) {
            return $this->createJsonBadRequestResponse(
                $form->getErrors()
            );
        }

        $this->container->get('sir.majora_entity.domain')->create($majoraEntity);

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

        $form = $this->container->get('form.factory')->create(
            new MajoraEntityType(),
            $majoraEntity,
            array('method' => 'PUT')
        );

        if (!$this->submitJsonData($request, $form)) {
            return $this->createJsonBadRequestResponse(
                $form->getErrors()
            );
        }

        $this->container->get('sir.majora_entity.domain')->edit($majoraEntity);

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

        $this->container->get('sir.majora_entity.domain')->delete($majoraEntity);

        return $this->createJsonNoContentResponse();
    }
}
