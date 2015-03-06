<?php

namespace Majora\Framework\Model;

/**
 * Interface to implements objects
 * which can be used into entity collections.
 */
interface CollectionableInterface
    extends SerializableInterface
{
    /**
     * return object id.
     *
     * @return integer
     */
    public function getId();
}
