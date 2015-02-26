<?php

namespace SirSdk\Component\MajoraNamespace\Repository;

use SirSdk\Component\MajoraNamespace\Model\MajoraEntity;

/**
 * Interface to implement on all MajoraEntity repositories
 *
 * @package majora-namespace
 * @subpackage repository
 */
interface MajoraEntityRepositoryInterface
{
    /**
     * update or create given MajoraEntity into persistence layer
     *
     * @param MajoraEntity $majoraEntity
     */
    public function save(MajoraEntity $majoraEntity);

    /**
     * delete MajoraEntity into persistence layer
     *
     * @param MajoraEntity $majoraEntity
     */
    public function delete(MajoraEntity $majoraEntity);
}
