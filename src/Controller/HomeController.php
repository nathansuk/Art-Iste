<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\ArtisansJob;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @return Response
     * @Route("/", name="home")
     */
    public function index(): Response
    {

        $articles = $this->getDoctrine()->getRepository(Articles::class)->findBy(array(), ['postedAt' => 'DESC'], '5');

        $artisanCategory = $this->getDoctrine()->getRepository(ArtisansJob::class)->findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'Accueil',
            'articles' => $articles,
            'categories' => $artisanCategory
        ]);
    }
}
