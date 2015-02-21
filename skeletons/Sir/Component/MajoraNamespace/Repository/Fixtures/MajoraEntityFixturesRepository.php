<?php

namespace Sir\Component\MajoraNamespace\Repository\Fixtures;

use Majora\Framework\Repository\Api\AbstractFixturesRepository;
use SirSdk\Component\MajoraNamespace\Model\MajoraEntity;
use SirSdk\Component\MajoraNamespace\Repository\MajoraEntityRepositoryInterface;

/**
 * MajoraEntity repository implementation using memory fixtures
 *
 * @package majora-namespace
 * @subpackage repository
 */
class MajoraEntityFixturesRepository
    extends AbstractFixturesRepository
    implements MajoraEntityRepositoryInterface
{
    /**
     * @see MajoraEntityRepositoryInterface::save()
     */
    public function save(MajoraEntity $majoraEntity)
    {
        return $this->doSave($majoraEntity);
    }

    /**
     * @see MajoraEntityRepositoryInterface::delete()
     */
    public function delete(MajoraEntity $majoraEntity)
    {
        return $this->doDelete($majoraEntity);
    }
}
