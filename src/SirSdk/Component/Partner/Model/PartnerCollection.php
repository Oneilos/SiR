<?php

namespace SirSdk\Component\Partner\Model;

use Majora\Framework\Model\EntityCollection;

/**
 * Partner model collection class.
 */
class PartnerCollection
    extends EntityCollection
{
    /**
     * @see SerializableInterface::deserialize()
     */
    public function deserialize(array $data)
    {
        $this->clear();
        $entities = array_map(
            function (array $partnerData) {
                return (new Partner())->deserialize($partnerData);
            },
            $data
        );

        foreach ($entities as $entity) {
            $this->set($entity->getId(), $entity);
        }

        return $this;
    }
}
