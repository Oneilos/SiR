<?php

namespace Majora\Framework\Domain;

/**
 * Base class for domains
 *
 * @package majora-framework
 * @subpackage domain
 */
abstract class AbstractDomain
{
    /**
     * assert given entity is valid on given scope
     *
     * @param object $entity
     * @param string $scope
     *
     * @throws Exception If given object is invalid on given scope
     */
    protected function assertEntityIsValid($entity, $scope = null)
    {

    }

    /**
     * fire given event
     *
     * @param string $eventName
     * @param Event  $event
     */
    protected function fireEvent($eventName, Event $event)
    {

    }
}
