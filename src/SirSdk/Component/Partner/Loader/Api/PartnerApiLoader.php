<?php

namespace SirSdk\Component\Partner\Loader\Api;

use SirSdk\Component\Partner\Loader\PartnerLoaderInterface;

/**
 * Partner loader implementation using Api.
 */
class PartnerApiLoader
    implements PartnerLoaderInterface
{
    use PartnerApiLoaderTrait;
}
