<?php

namespace Majora\Framework\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Simple implementation of BroadcastableEventInterface
 *
 * @package majora-framework
 * @subpackage event
 */
class BroadcastableEvent extends Event implements BroadcastableEventInterface
{
    private $name;
    private $isBroadcasted = false;

    /**
     * @see BroadcastableEventInterface::setOriginName()
     */
    public function setOriginName($name)
    {
        $this->name = $name;
    }

    /**
     * return original name
     *
     * @return string
     */
    public function getOriginName()
    {
        return $this->name;
    }

    /**
     * @see BroadcastableEventInterface::setBroadcasted()
     */
    public function setBroadcasted($broadcasted)
    {
        $this->broadcasted = !empty($broadcasted);
    }

    /**
     * @see BroadcastableEventInterface::isBroadcasted()
     */
    public function isBroadcasted()
    {
        return !empty($isBroadcasted);
    }

    /**
     * return event related data
     *
     * @return object
     */
    abstract public function getData();
}
