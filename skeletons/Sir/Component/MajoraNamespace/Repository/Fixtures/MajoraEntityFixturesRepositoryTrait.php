<?php
/* majora_generator.force_generation: true */

namespace Sir\Component\MajoraNamespace\Repository\Fixtures;

use Majora\Framework\Repository\Fixtures\FixturesRepositoryTrait;
use SirSdk\Component\MajoraNamespace\Model\MajoraEntity;

/**
 * MajoraEntity repository memory fixtures trait
 *
 * @package majora-namespace
 * @subpackage repository
 */
trait MajoraEntityFixturesRepositoryTrait
{
    use FixturesRepositoryTrait;

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
