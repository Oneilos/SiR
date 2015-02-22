<?php

namespace SirSdk\Component\MajoraNamespace\Model;

use Majora\Framework\Model\SerializableInterface;
use Majora\Framework\Model\SerializableTrait;

/**
 * MajoraEntity model class
 *
 * @package majora-namespace
 * @subpackage model
 */
class MajoraEntity
    implements SerializableInterface
{
    use SerializableTrait;

    protected $id;

    /**
     * return MajoraEntity id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * define MajoraEntity id
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
            'id'      => 'id'
        );
    }
}
