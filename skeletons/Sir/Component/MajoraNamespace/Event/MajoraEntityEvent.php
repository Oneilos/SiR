<?php

namespace Sir\Component\MajoraNamespace\Event;

use Majora\Framework\Event\BroadcastableEvent;
use SirSdk\Component\MajoraNamespace\Model\MajoraEntity;

/**
 * MajoraEntity specific event class.
 */
class MajoraEntityEvent
    extends BroadcastableEvent
{
    protected $majoraEntity;

    /**
     * construct.
     *
     * @param MajoraEntity $majoraEntity
     */
    public function __construct(MajoraEntity $majoraEntity)
    {
        $this->majoraEntity = $majoraEntity;
    }

    /**
     * return related.
     *
     * @return MajoraEntity
     */
    public function getMajoraEntity()
    {
        return $this->majoraEntity;
    }

    /**
     * @see BroadcastableEventInterface::getData()
     */
    public function getData()
    {
        return array(
            'majora_entity_id' => $this->getMajoraEntity()->getId(),
        );
    }
}
