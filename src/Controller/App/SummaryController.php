<?php


namespace App\Controller\App;


use App\Entity\Summary;
use App\Form\SummaryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SummaryController extends BaseController
{
    /**
     * @Route("/summaries", name="app_summaries_post", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function postAction(Request $request)
    {
        $summary = new Summary();
        $form = $this->createForm(SummaryType::class, $summary);
        $nextForm = clone $form;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($summary);
            $this->em->flush();
            $this->addFlash('success', 'good');

            return $this->render('summary/create.html.twig', ['form' => $nextForm->createView()]);
        }
        return $this->render('summary/create.html.twig', ['form' =>  $form->createView()]);
    }
}