<?php

namespace Sir\Component\Partner\Loader;

use Majora\Framework\Loader\AbstractLoader;
use SirSdk\Component\Partner\Loader\PartnerLoaderInterface;

/**
 * Default Partner loader implementation.
 */
class PartnerLoader
    extends AbstractLoader
    implements PartnerLoaderInterface
{
    use PartnerLoaderTrait;
}
