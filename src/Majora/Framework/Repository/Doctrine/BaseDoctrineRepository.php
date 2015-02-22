<?php

namespace Majora\Framework\Repository\Api;

use Majora\Framework\Repository\RepositoryInterface;

/**
 * Base class for doctrine repository
 *
 * @package majora-framework
 * @subpackage repository
 */
class BaseDoctrineRepository implements RepositoryInterface
{
    /**
     * create entity query
     *
     * @param  string        $alias
     * @return QueryBuilder
     */
    protected function createQuery($alias = 'entity')
    {
        return $this->createQueryBuilder($alias);
    }

    /**
     * create query an filter it with given data
     *
     * @param  array $filters
     * @return Query
     */
    private function createFilteredQuery(array $filters)
    {
        $qb = $this->createQuery('entity');

        foreach ($filters as $field => $filter) {
            $qb->andWhere(is_array($filter) ?
                    sprintf('entity.%s in (:%s)', $field, $field) :
                    sprintf('entity.%s = :%s', $field, $field)
                )
                ->setParameter(sprintf(':%s', $field), $filter)
            ;
        }

        return $qb->getQuery();
    }

    /**
     * @see LoaderInterface::retrieveAll()
     */
    public function retrieveAll(array $filters = array(), $limit = null, $offset = null)
    {
        $query = $this->createFilteredQuery($filters);

        if ($limit) {
            $query->setMaxResults($limit);
        }
        if ($offset) {
            $query->setFirstResult($offset);
        }

        return $query->getResult();
    }

    /**
     * @see LoaderInterface::retrieve()
     */
    public function retrieve($id)
    {
        return $this->createFilteredQuery(array('id' => $id))
            ->getOneOrNullResult()
        ;
    }

    /**
     * @see RepositoryInterface::persist()
     */
    public function persist($entity)
    {
        $em = $this->getEntityManager();

        $em->persist($majoraEntity);
        $em->flush();
    }

    /**
     * @see RepositoryInterface::remove()
     */
    public function remove($entity)
    {
        $em = $this->getEntityManager();

        $em->remove($majoraEntity);
        $em->flush();
    }
}
