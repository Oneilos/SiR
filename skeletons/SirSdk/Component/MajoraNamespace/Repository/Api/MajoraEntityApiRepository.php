<?php

namespace SirSdk\Component\MajoraNamespace\Repository\Api;

use Majora\Framework\Repository\Api\AbstractApiRepository;
use SirSdk\Component\MajoraNamespace\Model\MajoraEntity;
use SirSdk\Component\MajoraNamespace\Repository\MajoraEntityRepositoryInterface;

/**
 * MajoraEntity repository implementation using an API
 *
 * @package majora-namespace
 * @subpackage repository
 */
class MajoraEntityApiRepository
    extends AbstractApiRepository
    implements MajoraEntityRepositoryInterface
{
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
