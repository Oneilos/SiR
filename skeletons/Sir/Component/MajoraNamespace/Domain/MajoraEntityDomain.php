<?php

namespace Sir\Component\MajoraNamespace\Domain;

use Majora\Framework\Domain\AbstractDomain;
use SirSdk\Component\MajoraNamespace\Domain\MajoraEntityDomainInterface;
use SirSdk\Component\MajoraNamespace\Repository\MajoraEntityRepositoryInterface;
use Sir\Component\MajoraNamespace\Event\MajoraEntityEvent;
use Sir\Component\MajoraNamespace\Event\MajoraEntityEvents;

/**
 * MajoraEntity domain use cases class
 *
 * @package majora-namespace
 * @subpackage domain
 *
 * Auto generated methods :
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
