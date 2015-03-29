<?php

namespace SirSdk\Component\Partner\Repository;

use SirSdk\Component\Partner\Model\Partner;

/**
 * Interface to implement on all Partner repositories.
 */
interface PartnerRepositoryInterface
{
    /**
     * update or create given Partner into persistence layer.
     *
     * @param Partner $partner
     */
    public function save(Partner $partner);

    /**
     * delete Partner into persistence layer.
     *
     * @param Partner $partner
     */
    public function delete(Partner $partner);
}
