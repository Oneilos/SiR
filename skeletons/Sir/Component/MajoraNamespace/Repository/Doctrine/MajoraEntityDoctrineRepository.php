<?php

namespace Sir\Component\MajoraNamespace\Repository\Doctrine;

use Majora\Framework\Repository\Api\BaseDoctrineRepository;
use SirSdk\Component\MajoraNamespace\Repository\MajoraEntityRepositoryInterface;

/**
 * MajoraEntity repository implementation using Doctrine
 *
 * @package majora-namespace
 * @subpackage repository
 */
class MajoraEntityDoctrineRepository
    extends BaseDoctrineRepository
    implements MajoraEntityRepositoryInterface
{
    /**
     * @see MajoraEntityRepositoryInterface::save()
     */
    public function save(MajoraEntity $majoraEntity)
    {
        $em = $this->getEntityManager();
        $em->persist($majoraEntity);

        return $majoraEntity;
    }

    /**
     * @see MajoraEntityRepositoryInterface::delete()
     */
    public function delete(MajoraEntity $majoraEntity)
    {
        $em = $this->getEntityManager();
        $em->remove($majoraEntity);

        return $majoraEntity;
    }
}
