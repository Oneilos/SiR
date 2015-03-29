<?php

namespace Sir\Component\MajoraNamespace\Loader;

use Majora\Framework\Loader\AbstractLoader;
use SirSdk\Component\MajoraNamespace\Loader\MajoraEntityLoaderInterface;

/**
 * Default MajoraEntity loader implementation.
 */
class MajoraEntityLoader
    extends AbstractLoader
    implements MajoraEntityLoaderInterface
{
    use MajoraEntityLoaderTrait;
}
