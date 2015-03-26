<?php
/* majora_generator.force_generation: true */

namespace Sir\Bundle\PartnerBundle\Controller;

use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Majora\Bundle\FrameworkExtraBundle\Controller\RestApiControllerTrait;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use SirSdk\Component\Partner\Model\Partner;
use Sir\Bundle\PartnerBundle\Form\Type\PartnerType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Auto generated controller trait for Partner entity.
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
trait PartnerRestApiControllerTrait
{
    use RestApiControllerTrait;

    /**
     * Returns a collection of Partners.
     *
     * @View()
     * @ApiDoc(
     *    description="Returns a collection of Partners",
     *    tags={"in-dev"="#FACC2E"},
     *    section="Partner",
     *    groups={"public"},
     *    output="SirSdk\Component\Partner\Model\Partner",
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
            $this->container->get('sir.partner.loader')->retrieveAll(
                $this->extractQueryFilter($request),
                $paramFetcher->get('limit'),
                $paramFetcher->get('offset')
            ),
            $paramFetcher->get('scope')
        );
    }

    /**
     * Returns a single Partner by id.
     *
     * @View()
     * @ApiDoc(
     *    description="Returns a single Partner by id",
     *    tags={"in-dev"="#FACC2E"},
     *    section="Partner",
     *    groups={"public"},
     *    output="SirSdk\Component\Partner\Model\Partner",
     *    requirements={
     *        {"name"="id", "dataType"="integer", "requirement"="\d+", "description"="Requested Partner id"}
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
            $this->retrieveOr404($id, 'sir.partner.loader')
        );
    }

    /**
     * @View()
     * @ApiDoc(
     *    description="Create a new Partner",
     *    tags={"in-dev"="#FACC2E"},
     *    section="Partner",
     *    groups={"private"},
     *    input="Sir\Bundle\PartnerBundle\Form\Type\PartnerType",
     *    output="SirSdk\Component\Partner\Model\Partner",
     *    statusCodes={
     *        201="Returned when successful",
     *        400="If invalid data",
     *        403="If method access denied"
     *    }
     * )
     */
    public function postAction(Request $request)
    {
        $partner = new Partner();

        $form = $this->container->get('form.factory')->create(
            new PartnerType(),
            $partner
        );

        if (!$this->submitJsonData($request, $form)) {
            return $this->createJsonBadRequestResponse(
                $form->getErrors()
            );
        }

        $this->container->get('sir.partner.domain')->create($partner);

        return $this->createJsonResponse(
            $partner
        );
    }

    /**
     * @View(statusCode=204)
     * @ApiDoc(
     *    description="Update Partner data for given id",
     *    tags={"in-dev" = "#FACC2E"},
     *    section="Partner",
     *    groups={"private"},
     *    input="Sir\Bundle\PartnerBundle\Form\Type\PartnerType",
     *    requirements={
     *      {"name"="id", "dataType"="integer", "requirement"="\d+", "description"="Requested Partner id"}
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
        $partner = $this->retrieveOr404($id, 'sir.partner.loader');

        $form = $this->container->get('form.factory')->create(
            new PartnerType(),
            $partner,
            array('method' => 'PUT')
        );

        if (!$this->submitJsonData($request, $form)) {
            return $this->createJsonBadRequestResponse(
                $form->getErrors()
            );
        }

        $this->container->get('sir.partner.domain')->edit($partner);

        return $this->createJsonNoContentResponse();
    }

    /**
     * @View()
     * @ApiDoc(
     *    description="Deletes Partner for given id",
     *    tags={"in-dev"="#FACC2E"},
     *    section="Partner",
     *    groups={"private"},
     *    requirements={
     *        {"name"="id", "dataType"="integer", "requirement"="\d+", "description"="Requested Partner id"}
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
        $partner = $this->retrieveOr404($id, 'sir.partner.loader');

        $this->container->get('sir.partner.domain')->delete($partner);

        return $this->createJsonNoContentResponse();
    }
}
