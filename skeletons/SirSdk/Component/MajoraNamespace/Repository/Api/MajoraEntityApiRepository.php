<?php

namespace SirSdk\Component\MajoraNamespace\Repository\Api;

use Majora\Framework\Repository\Api\AbstractApiRepository;
use Majora\Framework\Repository\RepositoryInterface;
use SirSdk\Component\MajoraNamespace\Model\MajoraEntity;
use SirSdk\Component\MajoraNamespace\Repository\MajoraEntityRepositoryInterface;

/**
 * MajoraEntity repository implementation using an API
 *
 * @package majora-namespace
 * @subpackage repository
 *
 * @see MajoraEntityApiRepository::save(MajoraEntity $majoraEntity)
 * @see MajoraEntityApiRepository::delete(MajoraEntity $majoraEntity)
 */
class MajoraEntityApiRepository
    implements MajoraEntityRepositoryInterface, RepositoryInterface
{
    use MajoraEntityApiRepositoryTrait;
}
