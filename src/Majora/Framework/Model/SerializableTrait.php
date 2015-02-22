<?php

namespace Majora\Framework\Model;

use InvalidArgumentException;
use Majora\Framework\Model\ScopableInterface;

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
     * @see SerializableInterface::toArray()
     */
    public function toArray($scope = 'default')
    {
        $scopes = $this->getScopes();
        if (!isset($scopes[$scope])) {
            throw new InvalidArgumentException(sprintf(
                'Invalid scope for %s object, only [%s] supported, "%s" given.',
                __CLASS__,
                implode(', ', array_keys($scopes)),
                $scope
            ));
        }

        if (is_string($scopes[$scope])) {
            $method = sprintf('get%s', ucfirst($scopes[$scope]));
            return $this->$method();
        }

        $data  = array();
        $stack = array($scopes[$scope]);
        while(true) {
            $scope = array_shift($stack);
            foreach ($scope as $fieldConfig) {
                if (strpos($fieldConfig, '@') === false) {
                    $method = sprintf('get%s', ucfirst($fieldConfig));
                    $data[$fieldConfig] = $this->$method();
                    continue;
                }

                list($field, $includeScope) = explode('@', $fieldConfig);
                if (empty($field)) {
                    array_unshift($stack, $scopes[$includeScope]);
                    continue;
                }

                $method        = sprintf('get%s', ucfirst($field));
                $relatedEntity = $this->$method();
                $data[$fieldConfig] = $relatedEntity instanceof ScopableInterface ?
                    $relatedEntity->toArray($includeScope) :
                    $relatedEntity
                ;
            }

            if (empty($stack)) {
                break;
            }
        }

        return $data;
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
