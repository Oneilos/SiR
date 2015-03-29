<?php

namespace Sir\Component\Partner\Repository\Fixtures;

use Majora\Framework\Repository\Fixtures\AbstractFixturesRepository;
use Majora\Framework\Repository\RepositoryInterface;
use SirSdk\Component\Partner\Repository\PartnerRepositoryInterface;

/**
 * Partner repository implementation using memory fixtures.
 */
class PartnerFixturesRepository
    extends AbstractFixturesRepository
    implements PartnerRepositoryInterface, RepositoryInterface
{
    use PartnerFixturesRepositoryTrait;
}
