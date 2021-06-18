<?php

namespace App\Controller\Artisan;

use App\Entity\Artisan;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtisanSearchController extends AbstractController
{
    /**
     * @return Response
     * @Route("/search", name="artisan_search")
     */
    public function index(Request $request): Response
    {
        $category = $request->query->get('category');
        $city = $request->query->get('city');

        if($category && !$city){

            $results = $this->getDoctrine()->getRepository(Artisan::class)->findBy(['category' => $category]);

        }

        if($category && $city){

            $results = $this->getDoctrine()->getRepository(Artisan::class)->findBy(['category' => $category, 'city' => $city]);

        }




        return $this->render('artisan_search/index.html.twig', [
            'controller_name' => 'ArtisanSearchController',
            'results' => $results
        ]);
    }
}
