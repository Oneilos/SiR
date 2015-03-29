<?php
/* majora_generator.force_generation: true */

namespace Sir\Component\Partner\Repository\Fixtures;

use Majora\Framework\Repository\Fixtures\FixturesRepositoryTrait;
use SirSdk\Component\Partner\Model\Partner;

/**
 * Partner repository memory fixtures trait.
 */
trait PartnerFixturesRepositoryTrait
{
    use FixturesRepositoryTrait;

    /**
     * @see PartnerRepositoryInterface::save()
     */
    public function save(Partner $partner)
    {
        $this->persist($partner);

        return $partner;
    }

    /**
     * @see PartnerRepositoryInterface::delete()
     */
    public function delete(Partner $partner)
    {
        $this->remove($partner);

        return $partner;
    }
}
