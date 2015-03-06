<?php

namespace SirSdk\Component\MajoraNamespace\Domain\Api;

/**
 * MajoraEntity domain implementation using API.
 *
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
