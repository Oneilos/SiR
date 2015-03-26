<?php
/* majora_generator.force_generation: true */

namespace Sir\Component\Partner\Domain;

use Majora\Framework\Domain\DomainTrait;
use SirSdk\Component\Partner\Domain\PartnerDomainInterface;
use SirSdk\Component\Partner\Model\Partner;
use SirSdk\Component\Partner\Repository\PartnerRepositoryInterface;
use Sir\Component\Partner\Event\PartnerEvent;
use Sir\Component\Partner\Event\PartnerEvents;

/**
 * Partner domain use cases auto generated trait.
 *
 * @see DomainTrait::assertEntityIsValid()
 * @see DomainTrait::fireEvent()
 */
trait PartnerDomainTrait
{
    use DomainTrait;

    protected $partnerRepository;

    /**
     * construct.
     *
     * @param PartnerRepositoryInterface $partnerRepository
     */
    public function __construct(
        PartnerRepositoryInterface $partnerRepository
    ) {
        $this->partnerRepository = $partnerRepository;
    }

    /**
     * @see PartnerDomainInterface::create()
     */
    public function create(Partner $partner)
    {
        $this->assertEntityIsValid($partner, 'creation');

        $this->partnerRepository->save($partner);

        $this->fireEvent(
            PartnerEvents::SIR_PARTNER_CREATED,
            new PartnerEvent($partner)
        );
    }

    /**
     * @see PartnerDomainInterface::edit()
     */
    public function edit(Partner $partner)
    {
        $this->assertEntityIsValid($partner, 'edition');

        $this->partnerRepository->save($partner);

        $this->fireEvent(
            PartnerEvents::SIR_PARTNER_EDITED,
            new PartnerEvent($partner)
        );
    }

    /**
     * @see PartnerDomainInterface::delete()
     */
    public function delete(Partner $partner)
    {
        $this->assertEntityIsValid($partner, 'deletion');

        $this->partnerRepository->delete($partner);

        $this->fireEvent(
            PartnerEvents::SIR_PARTNER_DELETED,
            new PartnerEvent($partner)
        );
    }
}
