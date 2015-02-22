<?php

namespace Majora\Framework\Model;

use InvalidArgumentException;

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
    public function getScopes()
    {
        return array('default' => array('id'));
    }

    /**
     * @see SerializableInterface::fromArray()
     */
    public function fromArray(array $data)
    {
        foreach ($data as $property => $value) {
            if (!property_exists($this, $property)) {
                throw new InvalidArgumentException(sprintf(
                    'Try to set "%s" property on a %s object which doesnt exists.',
                    $property,
                    get_class($this)
                ));
            }

            $setter = sprintf('set%s', ucfirst($property));
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
            else {
                $this->$property = $value;
            }
        }

        return $this;
    }
}
