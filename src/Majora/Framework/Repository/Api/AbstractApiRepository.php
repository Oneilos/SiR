<?php

namespace Majora\Framework\Repository\Api;

use Majora\Framework\Repository\RepositoryInterface;

/**
 * Base class for api repository
 *
 * @package majora-framework
 * @subpackage repository
 */
abstract class AbstractApiRepository implements RepositoryInterface
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
