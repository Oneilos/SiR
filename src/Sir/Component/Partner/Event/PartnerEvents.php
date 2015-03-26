<?php

namespace Sir\Component\Partner\Event;

/**
 * Partner event reference class.
 */
final class PartnerEvents
{
    /**
     * event fired when a partner is created.
     */
    const SIR_PARTNER_CREATED = 'sir.partner.created';

    /**
     * event fired when a partner is updated.
     */
    const SIR_PARTNER_EDITED = 'sir.partner.edited';

    /**
     * event fired when a partner is deleted.
     */
    const SIR_PARTNER_DELETED = 'sir.partner.deleted';
}
