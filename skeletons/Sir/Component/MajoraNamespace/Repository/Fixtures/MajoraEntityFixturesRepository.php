<?php

namespace Sir\Component\MajoraNamespace\Repository\Fixtures;

use Majora\Framework\Repository\Fixtures\AbstractFixturesRepository;
use Majora\Framework\Repository\RepositoryInterface;
use SirSdk\Component\MajoraNamespace\Model\MajoraEntity;
use SirSdk\Component\MajoraNamespace\Repository\MajoraEntityRepositoryInterface;

/**
 * MajoraEntity repository implementation using memory fixtures
 *
 * @package majora-namespace
 * @subpackage repository
 */
class MajoraEntityFixturesRepository
    implements MajoraEntityRepositoryInterface, RepositoryInterface
{
    use MajoraEntityFixturesRepositoryTrait;
}
