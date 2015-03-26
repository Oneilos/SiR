<?php

namespace SirSdk\Component\Partner\Domain;

use SirSdk\Component\Partner\Model\Partner;

/**
 * Interface to implement on Partner domains.
 */
interface PartnerDomainInterface
{
    /**
     * trigger all Partner creation process.
     *
     * @param Partner $partner
     */
    public function create(Partner $partner);

    /**
     * trigger all Partner edition process.
     *
     * @param Partner $partner
     */
    public function edit(Partner $partner);

    /**
     * trigger all Partner deletion process.
     *
     * @param Partner $partner
     */
    public function delete(Partner $partner);
}
