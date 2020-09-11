<?php


namespace App\Controller\App;


use App\Entity\Category;
use App\Entity\Summary;
use App\Form\CategoryType;
use App\Form\SummaryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends BaseController
{
    /**
     * @Route("/categories", name="app_category_post", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function postAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $nextForm = clone $form;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($category);
            $this->em->flush();
            $this->addFlash('success', 'good');

            return $this->render('category/create.html.twig', ['form' => $nextForm->createView()]);
        }
        return $this->render('category/create.html.twig', ['form' => $form->createView()]);
    }
}