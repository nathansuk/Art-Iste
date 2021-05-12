<?php

namespace App\Controller;

use App\Entity\Articles;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @param int $id
     * @return Response
     * @Route("/article-{id}", name="show_article")
     */
    public function show(int $id): Response
    {
        $article = $this->getDoctrine()->getRepository(Articles::class)->find($id);

        if(!$article){
            return $this->redirectToRoute("home");
        }


        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'article' => $article
        ]);
    }
}
