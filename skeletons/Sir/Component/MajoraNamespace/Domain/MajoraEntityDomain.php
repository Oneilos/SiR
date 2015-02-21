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
 */
class MajoraEntityDomain
    extends AbstractDomain
    implements MajoraEntityDomainInterface
{
    protected $majoraEntityRepository;

    /**
     * construct
     *
     * @param MajoraEntityRepositoryInterface $majoraEntityRepository
     */
    public function __construct(
        MajoraEntityRepositoryInterface $majoraEntityRepository
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

        $this->fireEvent(
            MajoraEntityEvents::SIR_MAJORA_ENTITY_CREATED,
            new MajoraEntityEvent($majoraEntity)
        );
    }

    /**
     * @see MajoraEntityDomainInterface::edit()
     */
    public function edit(MajoraEntity $majoraEntity)
    {
        $this->assertEntityIsValid($majoraEntity, 'edition');

        $this->majoraEntityRepository->save($majoraEntity);

        $this->fireEvent(
            MajoraEntityEvents::SIR_MAJORA_ENTITY_EDITED,
            new MajoraEntityEvent($majoraEntity)
        );
    }

    /**
     * @see MajoraEntityDomainInterface::delete()
     */
    public function delete(MajoraEntity $majoraEntity)
    {
        $this->assertEntityIsValid($majoraEntity, 'deletion');

        $this->majoraEntityRepository->delete($majoraEntity);

        $this->fireEvent(
            MajoraEntityEvents::SIR_MAJORA_ENTITY_DELETED,
            new MajoraEntityEvent($majoraEntity)
        );
    }
}
