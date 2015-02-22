<?php

namespace Majora\Framework\Model;

/**
 * Interface to implements on all
 * scopable models
 *
 * @package majora-framework
 * @subpackage model
 */
interface SerializableInterface extends ScopableInterface
{
    /**
     * has to return an array representation of model
     *
     * @example
     *    return array(
     *        'id'        => $this->getId(),
     *        'firstname' => $this->getFirstname(),
     *        'skills'    => $this->getSkills()->toArray()
     *    );
     *
     * @return array
     */
    public function toArray($scope = 'default');

    /**
     * hydrate model from an array
     *
     * @param array $objectData model fields as array
     *
     * @return self
     */
    public function fromArray(array $objectData);
}
