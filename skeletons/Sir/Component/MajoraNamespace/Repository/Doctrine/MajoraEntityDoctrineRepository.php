<?php

namespace Sir\Component\MajoraNamespace\Repository\Doctrine;

use Majora\Framework\Repository\Doctrine\BaseDoctrineRepository;
use Majora\Framework\Repository\RepositoryInterface;
use SirSdk\Component\MajoraNamespace\Repository\MajoraEntityRepositoryInterface;

/**
 * MajoraEntity repository implementation using Doctrine.
 */
class MajoraEntityDoctrineRepository
    extends BaseDoctrineRepository
    implements MajoraEntityRepositoryInterface, RepositoryInterface
{
    use MajoraEntityDoctrineRepositoryTrait;
}
