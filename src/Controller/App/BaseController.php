<?php


namespace App\Controller\App;


use App\Service\FilterProcessor;
use App\Service\Paginator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class BaseController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var Paginator
     */
    protected $paginator;

    /**
     * BaseController constructor.
     * @param EntityManagerInterface $em
     * @param Paginator $paginator
     */
    public function __construct(EntityManagerInterface $em,
                                Paginator $paginator)
    {
        $this->em = $em;
        $this->paginator = $paginator;
    }

    protected function getFilters($request)
    {
        //get and decode json filters
        if ($request->query->has('filters')) {
            $filters = $request->query->get('filters');
            if (!is_array($filters)) {
                $filters = json_decode($request->query->get('filters'), true);
            }
        } else {
            $filters = array();
        }

        $sortParameter = $request->query->get('sort');
        //if sort is equal either asc or desc, then let it be. Otherwise, desc.
        $sort = $sortParameter ? $sortParameter : 'desc';
        $sortFieldParameter = $request->query->get('sortField');
        //if sortField is set, then let it be. Otherwise, id.
        $sortField = $sortFieldParameter ? $sortFieldParameter : 'id';

        return [
            'filters' => $filters,
            'sort' => $sort,
            'sortField' => $sortField
        ];
    }

    private function isPositiveInt($string)
    {
        return is_numeric($string) && $string > 0;
    }
}