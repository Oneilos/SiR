<?php

namespace Sir\Component\Partner\Domain;

use Majora\Framework\Domain\AbstractDomain;
use SirSdk\Component\Partner\Domain\PartnerDomainInterface;
use SirSdk\Component\Partner\Repository\PartnerRepositoryInterface;

/**
 * Partner domain use cases class.
 *
 * @see PartnerDomainTrait::__construct(PartnerRepositoryInterface $partnerRepository)
 * @see PartnerDomainTrait::create(Partner $partner)
 * @see PartnerDomainTrait::edit(Partner $partner)
 * @see PartnerDomainTrait::delete(Partner $partner)
 */
class PartnerDomain
    extends AbstractDomain
    implements PartnerDomainInterface
{
    use PartnerDomainTrait;
}
