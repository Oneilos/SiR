<?php

namespace Sir\Component\Partner\Event;

use Majora\Framework\Event\BroadcastableEvent;
use SirSdk\Component\Partner\Model\Partner;

/**
 * Partner specific event class.
 */
class PartnerEvent
    extends BroadcastableEvent
{
    protected $partner;

    /**
     * construct.
     *
     * @param Partner $partner
     */
    public function __construct(Partner $partner)
    {
        $this->partner = $partner;
    }

    /**
     * return related.
     *
     * @return Partner
     */
    public function getPartner()
    {
        return $this->partner;
    }

    /**
     * @see BroadcastableEventInterface::getData()
     */
    public function getData()
    {
        return array(
            'partner_id' => $this->getPartner()->getId(),
        );
    }
}
