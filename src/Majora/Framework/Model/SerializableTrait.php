<?php

namespace Majora\Framework\Model;

/**
 * Implements a generic serializable trait
 *
 * @see SerializableInterface
 * @see ScopableInterface
 *
 * @package majora-framework
 * @subpackage model
 */
trait SerializableTrait
{
    /**
     * @see ScopableInterface::getScope()
     */
    public function getScope()
    {
        return array('default' => array('id'));
    }

    /**
     * @see SerializableInterface::fromArray()
     */
    public function fromArray(array $data)
    {
        return $this;
    }
}
