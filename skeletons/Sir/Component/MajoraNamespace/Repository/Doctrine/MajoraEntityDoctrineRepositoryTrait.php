<?php
/* majora_generator.force_generation: true */

namespace Sir\Component\MajoraNamespace\Repository\Doctrine;

use Majora\Framework\Repository\Doctrine\DoctrineRepositoryTrait;
use SirSdk\Component\MajoraNamespace\Model\MajoraEntity;

/**
 * MajoraEntity repository trait for Doctrine.
 */
trait MajoraEntityDoctrineRepositoryTrait
{
    use DoctrineRepositoryTrait;

    /**
     * @see MajoraEntityRepositoryInterface::save()
     */
    public function save(MajoraEntity $majoraEntity)
    {
        $em = $this->getEntityManager();
        $em->persist($majoraEntity);
        $em->flush();

        return $majoraEntity;
    }

    /**
     * @see MajoraEntityRepositoryInterface::delete()
     */
    public function delete(MajoraEntity $majoraEntity)
    {
        $em = $this->getEntityManager();
        $em->remove($majoraEntity);
        $em->flush();

        return $majoraEntity;
    }
}
