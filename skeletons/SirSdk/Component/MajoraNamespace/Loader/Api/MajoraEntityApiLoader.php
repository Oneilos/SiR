<?php

namespace SirSdk\Component\MajoraNamespace\Loader\Api;

use SirSdk\Component\MajoraNamespace\Loader\MajoraEntityLoaderInterface;

/**
 * MajoraEntity loader implementation using Api
 *
 * @package majora-namespace
 * @subpackage loader
 */
class MajoraEntityApiLoader
    implements MajoraEntityLoaderInterface
{
    use MajoraEntityApiLoaderTrait;
}
