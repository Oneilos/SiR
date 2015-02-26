<?php

namespace Majora\Framework\Serializer\Json;

use Majora\Framework\Serializer\Collection\CollectionHandler;
use Majora\Framework\Serializer\Json\Exception\JsonDeserializationException;

/**
 * Handler implementation creating and using json
 *
 * @package majora-framework
 * @subpackage serializer
 */
class JsonHandler
    extends CollectionHandler
{
    /**
     * @see FormatHandlerInterface::serialize()
     */
    public function serialize($data, $scope)
    {
        return json_encode(parent::serialize($data, $scope));
    }

    /**
     * @see FormatHandlerInterface::deserialize()
     */
    public function deserialize($data, $output)
    {
        $arrayData = json_decode($data, true);
        if (null === $arrayData) {
            throw new JsonDeserializationException(sprintf(
                'Invalid json data, error %s : %s',
                json_last_error(),
                json_last_error_msg()
            ));
        }

        return parent::deserialize($arrayData, $output);
    }
}
