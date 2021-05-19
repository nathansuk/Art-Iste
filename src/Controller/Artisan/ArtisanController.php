<?php

namespace App\Controller\Artisan;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtisanController extends AbstractController
{
    /**
     * @return Response
     * @Route("/artisan", name="show_artisan")
     */
    public function index(): Response
    {
        return $this->render('artisan/index.html.twig', [
            'controller_name' => 'Artisan',
        ]);
    }
}
