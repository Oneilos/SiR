<?php
/* majora_generator.force_generation: true */

namespace Sir\Component\MajoraNamespace\Repository\Doctrine;

use Majora\Framework\Repository\Api\DoctrineRepositoryTrait;

/**
 * MajoraEntity repository trait for Doctrine
 *
 * @package majora-namespace
 * @subpackage repository
 */
trait MajoraEntityDoctrineRepositoryTrait
{
    use DoctrineRepositoryTrait;

    /**
     * @see MajoraEntityRepositoryInterface::save()
     */
    public function save(MajoraEntity $majoraEntity)
    {
        $this->persist($majoraEntity);

        return $majoraEntity;
    }

    /**
     * @see MajoraEntityRepositoryInterface::delete()
     */
    public function delete(MajoraEntity $majoraEntity)
    {
        $this->remove($majoraEntity);

        return $majoraEntity;
    }
}
