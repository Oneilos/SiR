<?php

namespace Sir\Component\MajoraNamespace\Repository\Fixtures;

use Majora\Framework\Repository\Fixtures\AbstractFixturesRepository;
use Majora\Framework\Repository\RepositoryInterface;
use SirSdk\Component\MajoraNamespace\Model\MajoraEntity;
use SirSdk\Component\MajoraNamespace\Repository\MajoraEntityRepositoryInterface;
use Sir\Component\MajoraNamespace\Repository\Fixtures\MajoraEntityFixturesRepositoryTrait;

/**
 * MajoraEntity repository implementation using memory fixtures.
 */
class MajoraEntityFixturesRepository
    implements MajoraEntityRepositoryInterface, RepositoryInterface
{
    use MajoraEntityFixturesRepositoryTrait;
}
