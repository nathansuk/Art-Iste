<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Services\Articles\ArticlesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @param int $id
     * @param ArticlesService $articlesService
     * @return Response
     * @Route("/article/{id}", name="show_article")
     */
    public function show(int $id, ArticlesService $articlesService): Response
    {
        $article = $articlesService->getArticleById($id);

        if(!$article){
            return $this->redirectToRoute("home");
        }

        return $this->render('article/index.html.twig', [
            'controller_name' => $article->getTitle(),
            'article' => $article
        ]);
    }

    /**
     * @Route("/blog", name="listing_article")
     * @param ArticlesService $articlesService
     * @return Response
     */
    public function index(ArticlesService $articlesService): Response {

        $articles = $articlesService->getAllArticle();

        return $this->render('article/liste.html.twig', [
            'controller_name' => 'Actualité',
            'articles' => $articles
        ]);
    }

}
