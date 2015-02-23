<?php

namespace Sir\Component\MajoraNamespace\Repository\Doctrine;

use Doctrine\ORM\EntityRepository;
use Majora\Framework\Repository\RepositoryInterface;
use SirSdk\Component\MajoraNamespace\Repository\MajoraEntityRepositoryInterface;

/**
 * MajoraEntity repository implementation using Doctrine
 *
 * @package majora-namespace
 * @subpackage repository
 */
class MajoraEntityDoctrineRepository
    extends EntityRepository
    implements MajoraEntityRepositoryInterface, RepositoryInterface
{
    use MajoraEntityDoctrineRepositoryTrait;
}
