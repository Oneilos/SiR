<?php

namespace Majora\Framework\Domain;

use Majora\Framework\Validation\ValidationException;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\ValidatorInterface;

/**
 * Base trait for domains.
 */
trait DomainTrait
{
    protected $validator;
    protected $eventDispatcher;

    /**
     * define event dispatcher.
     *
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * define validator.
     *
     * @param ValidatorInterface $validator
     */
    public function setValidator(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * assert given entity is valid on given scope.
     *
     * @param object $entity
     * @param string $scope
     *
     * @throws ValidationException If given object is invalid on given scope
     */
    protected function assertEntityIsValid($entity, $scope = null)
    {
        if (!$this->validator) {
            throw new \BadMethodCallException(sprintf(
                'Method %s() cannot be used while validator isnt configured.',
                __METHOD__
            ));
        }

        $violationList = $this->validator->validate(
            $entity,
            $scope ? (array) $scope : null
        );

        if (!count($violationList)) {
            return;
        }

        throw new ValidationException(
            $entity,
            $violationList,
            $scope ? (array) $scope : null
        );
    }

    /**
     * fire given event.
     *
     * @param string $eventName
     * @param Event  $event
     *
     * @throws BadMethodCallException If any event dispatcher set
     */
    protected function fireEvent($eventName, Event $event)
    {
        if (!$this->eventDispatcher) {
            throw new \BadMethodCallException(sprintf(
                'Method %s() cannot be used while event dispatcher isnt configured.',
                __METHOD__
            ));
        }

        $this->eventDispatcher->dispatch($eventName, $event);
    }
}
