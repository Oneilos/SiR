<?php

namespace Sir\Component\Partner\Repository\Doctrine;

use Majora\Framework\Repository\Doctrine\BaseDoctrineRepository;
use Majora\Framework\Repository\RepositoryInterface;
use SirSdk\Component\Partner\Repository\PartnerRepositoryInterface;

/**
 * Partner repository implementation using Doctrine.
 */
class PartnerDoctrineRepository
    extends BaseDoctrineRepository
    implements PartnerRepositoryInterface, RepositoryInterface
{
    use PartnerDoctrineRepositoryTrait;
}
