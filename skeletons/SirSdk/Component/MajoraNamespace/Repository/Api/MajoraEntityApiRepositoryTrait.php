<?php

namespace SirSdk\Component\MajoraNamespace\Repository\Api;

use Majora\Framework\Repository\Api\ApiRepositoryTrait;
use SirSdk\Component\MajoraNamespace\Model\MajoraEntity;

/**
 * MajoraEntity repository implementation using an API
 *
 * @package majora-namespace
 * @subpackage repository
 *
 * @see ApiRepositoryTrait::retrieveAll(array $filters = array(), $limit = null, $offset = null)
 * @see ApiRepositoryTrait::retrieve($id)
 * @see ApiRepositoryTrait::persist($entity)
 * @see ApiRepositoryTrait::remove($entity)
 */
trait MajoraEntityApiRepositoryTrait
{
    use ApiRepositoryTrait;

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
