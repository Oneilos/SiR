<?php

namespace Majora\Framework\Domain;

use Symfony\Component\EventDispatcher\Event;

/**
 * Base trait for domains.
 */
trait DomainTrait
{
    /**
     * assert given entity is valid on given scope.
     *
     * @param object $entity
     * @param string $scope
     *
     * @throws \Exception If given object is invalid on given scope
     */
    protected function assertEntityIsValid($entity, $scope = null)
    {
    }

    /**
     * fire given event.
     *
     * @param string $eventName
     * @param Event  $event
     */
    protected function fireEvent($eventName, Event $event)
    {
    }
}
