<?php

namespace Majora\Framework\Repository;

use Majora\Framework\Loader\LoaderInterface;

/**
 * General repository interface
 *
 * @package majora-framework
 * @subpackage repository
 */
interface RepositoryInterface extends LoaderInterface
{
    /**
     * save given entity data into persistence layer
     *
     * @param mixed $entity
     */
    public function persist($entity);

    /**
     * delete given entity data from persistence layer
     *
     * @param mixed $entity
     */
    public function remove($entity);
}
