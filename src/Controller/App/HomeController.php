<?php


namespace App\Controller\App;


use App\Entity\Category;
use App\Service\Filter\IFilterProcessor;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends BaseController
{
    /**
     * @Route("/", name="app_home_page", methods={"GET"})
     * @return Response
     */
    public function indexAction(Request $request, IFilterProcessor $filterProcessor)
    {

        $filterParameters = $this->getFilters($request);
        //filter query
        $filterProcessor->makeQuery(
            $filterParameters['filters'],
            'Summary',
            $filterParameters['sortField'],
            $filterParameters['sort']
        );
        $data = $filterProcessor->getQuery();
        $summaries = $this->paginator->paginate($data);
        $categories = $this->em
            ->getRepository(Category::class)
            ->getAllPrimaries()
            ->getResult();

        return $this->render('home/index.html.twig', ['summaries' => $summaries, 'categories' => $categories]);
    }
}