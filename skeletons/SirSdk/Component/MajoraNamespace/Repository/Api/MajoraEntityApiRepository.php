<?php

namespace SirSdk\Component\MajoraNamespace\Repository\Api;

use Majora\Framework\Repository\Api\AbstractApiRepository;
use Majora\Framework\Repository\RepositoryInterface;
use SirSdk\Component\MajoraNamespace\Repository\MajoraEntityRepositoryInterface;

/**
 * MajoraEntity repository implementation using an API.
 *
 * @see MajoraEntityApiRepository::save(MajoraEntity $majoraEntity)
 * @see MajoraEntityApiRepository::delete(MajoraEntity $majoraEntity)
 */
class MajoraEntityApiRepository
    extends AbstractApiRepository
    implements MajoraEntityRepositoryInterface, RepositoryInterface
{
    use MajoraEntityApiRepositoryTrait;
}
