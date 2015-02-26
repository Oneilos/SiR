<?php

namespace Majora\Framework\Model;

use BadMethodCallException;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Base class for entity aggregation collection.
 */
class EntityCollection
    extends ArrayCollection
    implements SerializableInterface
{
    /**
     * return all elements.
     *
     * @return array
     */
    public function all()
    {
        return parent::toArray();
    }

    /**
     * return all collection to arrays.
     *
     * @return array
     */
    public function toArray($scope = 'default')
    {
        return array_values(array_map(
            function (SerializableInterface $entity) use ($scope) {
                return $entity->toArray($scope);
            },
            $this->all()
        ));
    }

    /**
     * @see SerializableInterface::fromArray()
     */
    public function fromArray(array $data)
    {
        throw new BadMethodCallException(sprintf('%s() method has to be defined in %s class.',
            __CLASS__, get_class($this)
        ));
    }

    /**
     * @see ScopableInterface::getScopes()
     */
    public function getScopes()
    {
        return array();
    }

    /**
     * filter given collection on given fields.
     *
     * @param array $filters
     *
     * @return EntityCollection
     */
    public function search(array $filters)
    {
        return $this->filter(function (CollectionableInterface $entity) use ($filters) {
            $res = true;
            foreach ($filters as $key => $value) {
                $method = sprintf('get%s', ucfirst($key));
                $res = $res
                    && method_exists($entity, $method)
                    && (is_array($value) ?
                        in_array($entity->$method(), $value) :
                        $entity->$method() == $value
                    )
                ;
            }

            return $res;
        });
    }

    /**
     * extract the first $length elements from collection.
     *
     * @param int $length
     *
     * @return EntityCollection
     */
    public function chunk($length)
    {
        $chunkedData = array_chunk($this->all(), $length, true);

        return new self(empty($chunkedData) ? array() : $chunkedData[0]);
    }

    /**
     * @see ArrayCollection::slice()
     *
     * @return EntityCollection
     */
    public function slice($offset, $length = null)
    {
        return new self(parent::slice($offset, $length));
    }
}
