<?php

namespace Sir\Component\MajoraNamespace\Event;

/**
 * MajoraEntity event reference class.
 */
final class MajoraEntityEvents
{
    /**
     * event fired when a majora_entity is created.
     */
    const SIR_MAJORA_ENTITY_CREATED = 'sir.majora_entity.created';

    /**
     * event fired when a majora_entity is updated.
     */
    const SIR_MAJORA_ENTITY_EDITED = 'sir.majora_entity.edited';

    /**
     * event fired when a majora_entity is deleted.
     */
    const SIR_MAJORA_ENTITY_DELETED = 'sir.majora_entity.deleted';
}
