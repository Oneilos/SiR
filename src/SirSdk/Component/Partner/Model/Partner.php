<?php

namespace SirSdk\Component\Partner\Model;

use Majora\Framework\Model\CollectionableInterface;
use Majora\Framework\Model\CollectionableTrait;
use Majora\Framework\Serializer\Model\SerializableTrait;

/**
 * Partner model class.
 */
class Partner
    implements CollectionableInterface
{
    use CollectionableTrait, SerializableTrait;

    protected $id;

    /**
     * return Partner id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * define Partner id.
     *
     * @param integer $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    // *************************************************
    //
    // Class auto generated by MajoraGeneratorBundle
    // Implement your own logic here !
    //
    // *************************************************

    /**
     * @see ScopableInterface::getScopes()
     */
    public function getScopes()
    {
        return array(
            'default' => array('id'),
            'id'      => 'id',
        );
    }
}