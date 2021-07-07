<?php

namespace App\Controller\Artisan;

use App\Services\Artisan\FindArtisanService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtisanSearchController extends AbstractController
{
    /**
     * @param Request $request
     * @param FindArtisanService $findArtisanService
     * @return Response
     * @Route("/search", name="artisan_search")
     */
    public function index(Request $request, FindArtisanService $findArtisanService): Response
    {
        $category = $request->query->get('category');
        $city = $request->query->get('city');
        $atArtisansHome = $request->query->get('atHome');

        $results = $findArtisanService->findArtisan($category, $city, $atArtisansHome);

        return $this->render('artisan_search/index.html.twig', [
            'controller_name' => 'Résultats de votre recherche',
            'results' => $results
        ]);
    }
}
