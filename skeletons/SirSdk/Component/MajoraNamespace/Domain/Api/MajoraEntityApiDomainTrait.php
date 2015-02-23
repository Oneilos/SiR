<?php
// majora_generator.force_generation: true

namespace SirSdk\Component\MajoraNamespace\Domain\Api;

use Majora\Framework\Domain\DomainTrait;
use SirSdk\Component\MajoraNamespace\Model\MajoraEntity;
use SirSdk\Component\MajoraNamespace\Repository\Api\MajoraEntityApiRepository;

/**
 * MajoraEntity domain API traits
 *
 * @package majora-namespace
 * @subpackage domain
 *
 * @see DomainTrait::assertEntityIsValid($entity, $scope = null)
 * @see DomainTrait::fireEvent($eventName, Event $event)
 */
trait MajoraEntityApiDomainTrait
{
    use DomainTrait;

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
