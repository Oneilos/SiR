<?php

namespace SirSdk\Component\MajoraNamespace\Model;

use Majora\Framework\Model\BaseEntityCollection;

/**
 * MajoraEntity model collection class
 *
 * @package majora-namespace
 * @subpackage model
 */
class MajoraEntityCollection
    extends BaseEntityCollection
{
    /**
     * @see SerializableInterface::fromArray()
     */
    public function fromArray(array $data)
    {
        $this->clear();
        $entities = array_map(
            function(array $majoraEntityData) {
                return (new MajoraEntity())->fromArray($majoraEntityData);
            },
            $data
        );

        foreach ($entities as $entity) {
            $this->set($entity->getId(), $entity);
        }

        return $this;
    }
}
