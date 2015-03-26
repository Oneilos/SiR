<?php
/* majora_generator.force_generation: true */

namespace SirSdk\Component\Partner\Domain\Api;

use Majora\Framework\Domain\DomainTrait;
use SirSdk\Component\Partner\Model\Partner;
use SirSdk\Component\Partner\Repository\Api\PartnerApiRepository;

/**
 * Partner domain API traits.
 *
 * @see DomainTrait::assertEntityIsValid($entity, $scope = null)
 * @see DomainTrait::fireEvent($eventName, Event $event)
 */
trait PartnerApiDomainTrait
{
    use DomainTrait;

    protected $partnerRepository;

    /**
     * construct.
     *
     * @param PartnerApiRepository $partnerRepository
     */
    public function __construct(
        PartnerApiRepository $partnerRepository
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
    }

    /**
     * @see PartnerDomainInterface::edit()
     */
    public function edit(Partner $partner)
    {
        $this->assertEntityIsValid($partner, 'edition');

        $this->partnerRepository->save($partner);
    }

    /**
     * @see PartnerDomainInterface::delete()
     */
    public function delete(Partner $partner)
    {
        $this->assertEntityIsValid($partner, 'deletion');

        $this->partnerRepository->delete($partner);
    }
}
