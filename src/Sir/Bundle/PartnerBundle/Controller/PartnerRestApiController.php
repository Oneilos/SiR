<?php

namespace Sir\Bundle\PartnerBundle\Controller;

use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Request\ParamFetcherInterface;
use SirSdk\Component\Partner\Model\Partner;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Api controller for Partner entity.
 *
 *
 * @RouteResource("Partner")
 * @NamePrefix("api_rest_")
 *
 * Auto generated methods :
 *
 * @see PartnerRestApiTrait::cgetAction(ParamFetcherInterface $paramFetcher, Request $request)
 * @see PartnerRestApiTrait::getAction($id, Request $request)
 * @see PartnerRestApiTrait::postAction(Request $request)
 * @see PartnerRestApiTrait::putAction($id, Request $request)
 * @see PartnerRestApiTrait::deleteAction($id)
 */
class PartnerRestApiController extends Controller
{
    use PartnerRestApiControllerTrait;
}
