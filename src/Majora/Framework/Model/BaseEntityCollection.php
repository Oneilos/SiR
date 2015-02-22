<?php

namespace Majora\Framework\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Base class for entity aggregation collection
 *
 * @package majora-framework
 * @subpackage model
 */
class BaseEntityCollection extends ArrayCollection
{
    /**
     * filter given collection on given fields
     *
     * @param array $filters
     *
     * @return BaseEntityCollection
     */
    public function search(array $filters)
    {
        return $this->filter(function($entity) use ($filters) {
            $res = true;
            foreach ($filters as $key => $value) {
                $method = sprintf('get%s', ucfirst($key));
                $res = $res
                    && method_exists($entity, $method)
                    && (
                        is_array($value) ?
                            in_array($entity->$method(), $value) :
                            $entity->$method() == $value
                    )
                ;
            }
            return $res;
        });
    }

    /**
     * extract the first $length elements from collection
     *
     * @param int $length
     *
     * @return BaseEntityCollection
     */
    public function chunk($length)
    {
        $chunkedData = array_chunk($this->toArray(), $length, true);

        return new self(empty($chunkedData) ? array() : $chunkedData[0]);
    }

    /**
     * @see ArrayCollection::slice()
     * @return BaseEntityCollection
     */
    public function slice($offset, $length = null)
    {
        return new self(parent::slice($offset, $length));
    }
}
