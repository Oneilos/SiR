<?php

namespace Sir\Component\MajoraNamespace\Loader;

use Majora\Framework\Loader\BaseLoader;
use SirSdk\Component\MajoraNamespace\Loader\MajoraEntityLoaderInterface;

/**
 * Default MajoraEntity loader implementation
 *
 * @package majora-namespace
 * @subpackage loader
 */
class MajoraEntityLoader
    implements MajoraEntityLoaderInterface
{
    use MajoraEntityLoaderTrait;
}
