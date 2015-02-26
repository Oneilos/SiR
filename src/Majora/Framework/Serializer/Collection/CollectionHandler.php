<?php

namespace Majora\Framework\Serializer\Collection;

use Majora\Framework\Model\SerializableInterface;
use Majora\Framework\Serializer\FormatHandlerInterface;

/**
 * Handler implementation creating and using arrays
 *
 * @package majora-framework
 * @subpackage serializer
 */
class CollectionHandler
    implements FormatHandlerInterface
{
    /**
     * @see FormatHandlerInterface::serialize()
     */
    public function serialize($data, $scope)
    {
        if ($data instanceof SerializableInterface) {
            return $data->toArray($scope);
        }

        return (array) $data;
    }

    /**
     * @see FormatHandlerInterface::deserialize()
     */
    public function deserialize($data, $output)
    {
        if (!class_exists($output)) {
            return $data;
        }

        $object = new $output();

        return $object instanceof SerializableInterface ?
            $object->fromArray($data) :
            $object
        ;
    }
}
