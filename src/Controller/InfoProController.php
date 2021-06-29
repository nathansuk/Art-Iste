<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InfoProController extends AbstractController
{
    /**
     * @return Response
     * @Route("/professionnel", name="info_pro")
     */
    public function index(): Response
    {
        return $this->render('info_pro/index.html.twig', [
            'controller_name' => 'Solution pour professionnels',
        ]);
    }
}
