<?php


namespace App\Twig;


use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('getCategories', [$this, 'getCategories']),
        ];
    }

    public function getCategories($categoryId)
    {
        return $this->em
            ->getRepository(Category::class)
            ->getSubCategoriesByCategoryId($categoryId)
            ->getArrayResult();
    }
}