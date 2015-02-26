<?php

namespace SirSdk\Component\MajoraNamespace\Domain\Api;

use SirSdk\Component\MajoraNamespace\Repository\Api\MajoraEntityApiRepository;

/**
 * MajoraEntity domain implementation using API
 *
 * @package majora-namespace
 * @subpackage domain
 *
 * @see MajoraEntityApiDomainTrait::create(MajoraEntity $majoraEntity)
 * @see MajoraEntityApiDomainTrait::edit(MajoraEntity $majoraEntity)
 * @see MajoraEntityApiDomainTrait::delete(MajoraEntity $majoraEntity)
 */
class MajoraEntityApiDomain
    implements MajoraEntityDomainInterface
{
    use MajoraEntityApiDomainTrait;
}
