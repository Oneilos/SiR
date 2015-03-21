<?php

namespace Sir\Component\MajoraNamespace\Domain;

use Majora\Framework\Domain\BaseDomain;
use SirSdk\Component\MajoraNamespace\Domain\MajoraEntityDomainInterface;
use SirSdk\Component\MajoraNamespace\Repository\MajoraEntityRepositoryInterface;

/**
 * MajoraEntity domain use cases class.
 *
 * @see MajoraEntityDomainTrait::__construct(MajoraEntityRepositoryInterface $majoraEntityRepository)
 * @see MajoraEntityDomainTrait::create(MajoraEntity $majoraEntity)
 * @see MajoraEntityDomainTrait::edit(MajoraEntity $majoraEntity)
 * @see MajoraEntityDomainTrait::delete(MajoraEntity $majoraEntity)
 */
class MajoraEntityDomain
    extends BaseDomain
    implements MajoraEntityDomainInterface
{
    use MajoraEntityDomainTrait;
}
