<?php

namespace Sir\Component\MajoraNamespace\Domain;

use Majora\Framework\Domain\AbstractDomain;
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
    extends AbstractDomain
    implements MajoraEntityDomainInterface
{
    use MajoraEntityDomainTrait;
}
