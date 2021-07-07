<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Artisan;
use App\Entity\ArtisansJob;
use App\Services\Articles\ArticlesService;
use App\Services\Artisan\ArtisanService;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use MaxMind\Db\Reader\InvalidDatabaseException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @param ArticlesService $articlesService
     * @param ArtisanService $artisanService
     * @return Response
     * @Route("/", name="home")
     */
    public function index(ArticlesService $articlesService, ArtisanService $artisanService): Response
    {

        $articles = $articlesService->getListOfArticle(5);
        $artisanCategory = $artisanService->getAllArtisanCategories();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'Accueil',
            'articles' => $articles,
            'categories' => $artisanCategory,
        ]);
    }
}
