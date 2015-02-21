<?php

namespace SirSdk\Component\MajoraNamespace\Domain;

use SirSdk\Component\MajoraNamespace\Model\MajoraEntity;

/**
 * Interface to implement on MajoraEntity domains
 *
 * @package majora-namespace
 * @subpackage domain
 */
interface MajoraEntityDomainInterface
{
    /**
     * trigger all MajoraEntity creation process
     *
     * @param MajoraEntity $majoraEntity
     */
    public function create(MajoraEntity $majoraEntity);

    /**
     * trigger all MajoraEntity edition process
     *
     * @param MajoraEntity $majoraEntity
     */
    public function edit(MajoraEntity $majoraEntity);

    /**
     * trigger all MajoraEntity deletion process
     *
     * @param MajoraEntity $majoraEntity
     */
    public function delete(MajoraEntity $majoraEntity);
}
