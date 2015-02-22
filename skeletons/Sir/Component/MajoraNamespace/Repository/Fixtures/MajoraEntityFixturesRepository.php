<?php

namespace Sir\Component\MajoraNamespace\Repository\Fixtures;

use Majora\Framework\Repository\Fixtures\AbstractFixturesRepository;
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
