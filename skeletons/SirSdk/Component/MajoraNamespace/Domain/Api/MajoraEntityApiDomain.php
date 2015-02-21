<?php

namespace SirSdk\Component\MajoraNamespace\Domain\Api;

use Majora\Framework\Domain\AbstractDomain;
use SirSdk\Component\MajoraNamespace\Domain\MajoraEntityDomainInterface;
use SirSdk\Component\MajoraNamespace\Repository\Api\MajoraEntityApiRepository;

/**
 * MajoraEntity domain implementation using API
 *
 * @package majora-namespace
 * @subpackage domain
 */
class MajoraEntityApiDomain
    extends AbstractDomain
    implements MajoraEntityDomainInterface
{
    protected $majoraEntityRepository;

    /**
     * construct
     *
     * @param MajoraEntityApiRepository $majoraEntityRepository
     */
    public function __construct(
        MajoraEntityApiRepository $majoraEntityRepository
    )
    {
        $this->majoraEntityRepository = $majoraEntityRepository;
    }

    /**
     * @see MajoraEntityDomainInterface::create()
     */
    public function create(MajoraEntity $majoraEntity)
    {
        $this->assertEntityIsValid($majoraEntity, 'creation');

        $this->majoraEntityRepository->save($majoraEntity);
    }

    /**
     * @see MajoraEntityDomainInterface::edit()
     */
    public function edit(MajoraEntity $majoraEntity)
    {
        $this->assertEntityIsValid($majoraEntity, 'edition');

        $this->majoraEntityRepository->save($majoraEntity);
    }

    /**
     * @see MajoraEntityDomainInterface::delete()
     */
    public function delete(MajoraEntity $majoraEntity)
    {
        $this->assertEntityIsValid($majoraEntity, 'deletion');

        $this->majoraEntityRepository->delete($majoraEntity);
    }

}
