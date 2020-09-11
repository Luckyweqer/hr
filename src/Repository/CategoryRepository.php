<?php


namespace App\Repository;


use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    public function getAllPrimaries()
    {
        return $this->createQueryBuilder('c')
            ->where('c.category IS NULL')
            ->getQuery();
    }

    public function getSubCategoriesByCategoryId($id)
    {
        return $this->createQueryBuilder('c')
            ->where('c.category = :id')
            ->setParameter('id', $id)
            ->getQuery();
    }
}