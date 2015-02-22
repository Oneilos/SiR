<?php

namespace Majora\Framework\Model;

/**
 * Interface to implements on all
 * scopable models
 *
 * @package majora-framework
 * @subpackage model
 */
interface ScopableInterface
{
    /**
     * has to return all properties in scopes
     *
     * @example
     *    return array(
     *        'default' => array('id', 'code', 'label'),
     *        'id'      => 'id',
     *        'full'    => array('@default', 'related_entity@id', 'created_at', 'updated_at'),
     *        'extra'   => array('@full', 'related_entity')
     *    );
     *
     * @return array
     */
    public function getScopes();
}
