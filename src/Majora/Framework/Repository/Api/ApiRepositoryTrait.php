<?php

namespace Majora\Framework\Repository\Api;

/**
 * Base trait for api repository
 *
 * @package majora-framework
 * @subpackage repository
 */
trait ApiRepositoryTrait
{
    /**
     * @see LoaderInterface::retrieveAll()
     */
    public function retrieveAll(array $filters = array(), $limit = null, $offset = null)
    {
        return array();
    }

    /**
     * @see LoaderInterface::retrieve()
     */
    public function retrieve($id)
    {
        return null;
    }

    /**
     * @see RepositoryInterface::persist()
     */
    public function persist($entity)
    {
        return;
    }

    /**
     * @see RepositoryInterface::remove()
     */
    public function remove($entity)
    {
        return;
    }
}
