<?php

namespace Sir\Bundle\MajoraNamespaceBundle\Controller;

use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Request\ParamFetcherInterface;
use SirSdk\Component\MajoraNamespace\Model\MajoraEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Api controller for MajoraEntity entity.
 *
 *
 * @RouteResource("MajoraEntity")
 * @NamePrefix("api_rest_")
 *
 * Auto generated methods :
 *
 * @see MajoraEntityRestApiTrait::cgetAction(ParamFetcherInterface $paramFetcher, Request $request)
 * @see MajoraEntityRestApiTrait::getAction($id, Request $request)
 * @see MajoraEntityRestApiTrait::postAction(Request $request)
 * @see MajoraEntityRestApiTrait::putAction($id, Request $request)
 * @see MajoraEntityRestApiTrait::deleteAction($id)
 */
class MajoraEntityRestApiController extends Controller
{
    use MajoraEntityRestApiControllerTrait;
}
