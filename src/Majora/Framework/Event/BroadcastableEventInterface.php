<?php

namespace Majora\Framework\Event;

/**
 * Interface to implement on broadcastable events
 *
 * @package majora-framework
 * @subpackage domain
 */
interface BroadcastableEventInterface
{
    /**
     * define event original name
     *
     * @param string $name
     */
    public function setOriginName($name);

    /**
     * return original name
     *
     * @return string
     */
    public function getOriginName();

    /**
     * return event related data
     *
     * @return object
     */
    public function getData();

    /**
     * define is event is currently broadcasted
     *
     * @param boolean $broadcasted
     */
    public function setBroadcasted($broadcasted);

    /**
     * tests if event is currently broadcasted
     *
     * @return boolean
     */
    public function isBroadcasted();
}
