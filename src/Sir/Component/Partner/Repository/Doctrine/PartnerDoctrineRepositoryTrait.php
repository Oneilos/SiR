<?php
/* majora_generator.force_generation: true */

namespace Sir\Component\Partner\Repository\Doctrine;

use Majora\Framework\Repository\Doctrine\DoctrineRepositoryTrait;
use SirSdk\Component\Partner\Model\Partner;

/**
 * Partner repository trait for Doctrine.
 */
trait PartnerDoctrineRepositoryTrait
{
    use DoctrineRepositoryTrait;

    /**
     * @see PartnerRepositoryInterface::save()
     */
    public function save(Partner $partner)
    {
        $em = $this->getEntityManager();
        $em->persist($partner);
        $em->flush();

        return $partner;
    }

    /**
     * @see PartnerRepositoryInterface::delete()
     */
    public function delete(Partner $partner)
    {
        $em = $this->getEntityManager();
        $em->remove($partner);
        $em->flush();

        return $partner;
    }
}
