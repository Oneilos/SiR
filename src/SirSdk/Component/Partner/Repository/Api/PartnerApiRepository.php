<?php

namespace SirSdk\Component\Partner\Repository\Api;

use Majora\Framework\Repository\Api\AbstractApiRepository;
use Majora\Framework\Repository\RepositoryInterface;
use SirSdk\Component\Partner\Repository\PartnerRepositoryInterface;

/**
 * Partner repository implementation using an API.
 *
 * @see PartnerApiRepository::save(Partner $partner)
 * @see PartnerApiRepository::delete(Partner $partner)
 */
class PartnerApiRepository
    extends AbstractApiRepository
    implements PartnerRepositoryInterface, RepositoryInterface
{
    use PartnerApiRepositoryTrait;
}
