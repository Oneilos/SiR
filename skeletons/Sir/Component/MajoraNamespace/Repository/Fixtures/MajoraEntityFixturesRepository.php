<?php

namespace Sir\Component\MajoraNamespace\Repository\Fixtures;

use Majora\Framework\Repository\RepositoryInterface;
use SirSdk\Component\MajoraNamespace\Repository\MajoraEntityRepositoryInterface;

/**
 * MajoraEntity repository implementation using memory fixtures.
 */
class MajoraEntityFixturesRepository
    implements MajoraEntityRepositoryInterface, RepositoryInterface
{
    use MajoraEntityFixturesRepositoryTrait;
}
