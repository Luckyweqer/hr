<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class Paginator
{
    const LIMIT = 10;
    private $paginator;
    private $request;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(PaginatorInterface $paginator, RequestStack $request, EntityManagerInterface $em)
    {
        $this->paginator = $paginator;
        $this->request = $request->getCurrentRequest();
        $this->em = $em;
    }

    /**
     * @param $repository
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    public function paginate($repository, string $order = 'ASC')
    {
        if (is_string($repository)) {
            $repository = $this->em->getRepository($repository);
            $query = $this->makeQueryFromRepository($repository, $order);
        } elseif ($repository instanceof EntityRepository) {
            $query = $this->makeQueryFromRepository($repository, $order);
        } elseif ($repository instanceof QueryBuilder) {
            $query = $repository;
        } else {
            $query = $repository;
        }

        $page = $this->request->query->getInt('page', 1);
        $limit = $this->request->query->getInt('limit', self::LIMIT);

        $limit = $limit > self::LIMIT ? self::LIMIT : $limit;

        return $this->paginator->paginate($query, $page, $limit);
    }

    private function makeQueryFromRepository(EntityRepository $repository, string $order): Query
    {
        return $repository
            ->createQueryBuilder('repository')
            ->orderBy('repository.id', $order)
            ->getQuery();
    }
}