<?php


namespace App\Service\Filter;


interface IFilterProcessor
{
    /**
     * @param array $filters
     * @param string $className
     * @param string $orderField
     * @param string $orderBy
     * @param int|null $limit
     * @param int|null $offset
     * @param bool $disableSort
     * @return mixed
     */
    public function makeQuery(
        array $filters,
        string $className,
        string $orderField = 'id',
        string $orderBy = 'DESC',
        int $limit = null,
        int $offset = null,
        bool $disableSort = false
    );

    /**
     * @return mixed
     */
    public function getPermitTransaction();

    /**
     * @param $permitTransaction
     * @return mixed
     */
    public function setPermitTransaction($permitTransaction);

    /**
     * @return mixed
     */
    public function getResults();

    /**
     * @return mixed
     */
    public function getQuery();
}