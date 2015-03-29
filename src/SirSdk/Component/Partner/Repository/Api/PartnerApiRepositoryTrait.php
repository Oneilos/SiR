<?php
/* majora_generator.force_generation: true */

namespace SirSdk\Component\Partner\Repository\Api;

use Majora\Framework\Repository\Api\ApiRepositoryTrait;
use SirSdk\Component\Partner\Model\Partner;

/**
 * Partner repository implementation using an API.
 *
 *
 * @see ApiRepositoryTrait::retrieveAll(array $filters = array(), $limit = null, $offset = null)
 * @see ApiRepositoryTrait::retrieve($id)
 * @see ApiRepositoryTrait::persist($entity)
 * @see ApiRepositoryTrait::remove($entity)
 */
trait PartnerApiRepositoryTrait
{
    use ApiRepositoryTrait;

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
