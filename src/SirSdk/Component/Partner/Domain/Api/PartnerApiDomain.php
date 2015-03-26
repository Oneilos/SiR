<?php

namespace SirSdk\Component\Partner\Domain\Api;

use SirSdk\Component\Partner\Domain\PartnerDomainInterface;

/**
 * Partner domain implementation using API.
 *
 *
 * @see PartnerApiDomainTrait::create(Partner $partner)
 * @see PartnerApiDomainTrait::edit(Partner $partner)
 * @see PartnerApiDomainTrait::delete(Partner $partner)
 */
class PartnerApiDomain
    implements PartnerDomainInterface
{
    use PartnerApiDomainTrait;
}
