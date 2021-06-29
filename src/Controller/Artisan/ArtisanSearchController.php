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
     * @param Request $request
     * @return Response
     * @Route("/search", name="artisan_search")
     */
    public function index(Request $request): Response
    {
        $category = $request->query->get('category');
        $city = $request->query->get('city');
        $atArtisansHome = $request->query->get('atHome');

        if($category && $city && $atArtisansHome == 1) {
            $results = $this->getDoctrine()->getRepository(Artisan::class)->findBy([
                'category' => $category,
                'city' => $city,
                'atHome' => true
            ]);
        }

        if($category && $city && $atArtisansHome == 0) {
            $results = $this->getDoctrine()->getRepository(Artisan::class)->findBy([
                'category' => $category,
                'city' => $city,
                'canMove' => true
            ]);
        }

        return $this->render('artisan_search/index.html.twig', [
            'controller_name' => 'Résultats de votre recherche',
            'results' => $results
        ]);
    }
}
