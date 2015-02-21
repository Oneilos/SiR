<?php

namespace Sir\Component\MajoraNamespace\Event;

/**
 * MajoraEntity event reference class
 *
 * @package majora-namespace
 * @subpackage event
 */
final class MajoraEntityEvents
{
    /**
     * event fired when a majora_entity is created
     */
    const SIR_MAJORA_ENTITY_CREATED = 'sir.majora_entity.created';

    /**
     * event fired when a majora_entity is updated
     */
    const SIR_MAJORA_ENTITY_UPDATED = 'sir.majora_entity.updated';

    /**
     * event fired when a majora_entity is deleted
     */
    const SIR_MAJORA_ENTITY_DELETED = 'sir.majora_entity.deleted';
}
