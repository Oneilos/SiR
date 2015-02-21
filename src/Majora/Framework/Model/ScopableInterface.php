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
     *        'full'    => array('@default', 'created_at', 'updated_at')
     *    );
     *
     * @return array
     */
    public function getScopes();
}
