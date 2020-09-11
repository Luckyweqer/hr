<?php

namespace App\Service\Filter;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Description of FilterProcessor
 * Creates valid DQL filters for select query
 * Filters must be provided as an array of arrays:
 *      {"field" => "field_name", "value" => "value", "operator" => "operator"}
 * Acceptable Operator Values:
 *      eq | gt | lt | gte | lte | neq | in | notIn
 * @author eugene
 */
class FilterProcessor implements IFilterProcessor
{

    private $entityManager;
    private $queryBuilder;

    private $permitTransaction = true;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->queryBuilder = $entityManager->createQueryBuilder();
    }

    public function makeQuery(
        array $filters,
        string $className,
        string $orderField = 'id',
        string $orderBy = 'DESC',
        int $limit = null,
        int $offset = null,
        bool $disableSort = false
    )
    {
        //create base query: Select All from given Object
        $this->queryBuilder->select(array('object'))
            ->from('App:' . $className, 'object');
        //check if filters are not empty
        if (!empty($filters)) {
            for ($i = 0; $i < count($filters); $i++) {
                //add all filters
                $this->queryBuilder
                    ->andWhere($this->processFilter($filters[$i]));
            }
        }
        //set Order
        //$this->queryBuilder->orderBy('object.' . $orderField, $orderBy);
        if ($offset) {
            //set Offset            
            $this->queryBuilder->setFirstResult($offset);
        }
        if ($limit) {
            //set Limit
            $this->queryBuilder->setMaxResults($limit);
        }
        if (!$disableSort) {
            $this->queryBuilder->orderBy('object.' . $orderField, $orderBy);
        }
    }

    private function processFilter($filter)
    {
        switch ($filter['operator']) {
            case 'eq':
                return $this->queryBuilder->expr()
                    ->eq('object.' . $filter['field'],
                        "'" . $filter['value'] . "'");
            case 'gt':
                return $this->queryBuilder->expr()
                    ->gt('object.' . $filter['field'],
                        "'" . $filter['value'] . "'");
            case 'lt':
                return $this->queryBuilder->expr()
                    ->lt('object.' . $filter['field'],
                        "'" . $filter['value'] . "'");
            case 'lte':
                return $this->queryBuilder->expr()
                    ->lte('object.' . $filter['field'],
                        "'" . $filter['value'] . "'");
            case 'gte':
                return $this->queryBuilder->expr()
                    ->gte('object.' . $filter['field'],
                        "'" . $filter['value'] . "'");
            case 'neq':
                return $this->queryBuilder->expr()
                    ->neq('object.' . $filter['field'],
                        "'" . $filter['value'] . "'");
            case 'like':
                return $this->queryBuilder->expr()
                    ->like('object.' . $filter['field'],
                        "'" . $filter['value'] . "%'");
            case 'notLike':
                return $this->queryBuilder->expr()
                    ->notLike('object.' . $filter['field'],
                        "'" . $filter['value'] . "%'");
            case 'in':
                //filter['value'] must be an array here
                return $this->queryBuilder->expr()
                    ->in('object.' . $filter['field'],
                        "'" . implode("','", $filter['value']) . "'");
            case 'notIn':
                //filter['value'] must be an array here
                return $this->queryBuilder->expr()
                    ->notIn('object.' . $filter['field'],
                        "'" . implode("','", $filter['value']) . "'");
            case 'memberOf':
                $this->queryBuilder->setParameter('member', $filter['value']);
                return $this->queryBuilder->expr()
                    ->isMemberOf(":member",
                        'object.' . $filter['field']);
            default:
                return null;
        }
    }

    public function getPermitTransaction()
    {
        return $this->permitTransaction;
    }

    public function setPermitTransaction($permitTransaction)
    {
        $this->permitTransaction = $permitTransaction;
        return $this;
    }


    public function getResults()
    {
        //dump($this->queryBuilder->getDQL());
        if ($this->permitTransaction) {
            return $this->queryBuilder->getQuery()->getResult();
        } else {
            return "";
        }

    }

    public function getQuery()
    {
        //dump($this->queryBuilder->getDQL());
        if ($this->permitTransaction) {
            return $this->queryBuilder->getQuery();
        } else {
            return "";
        }

    }
}
