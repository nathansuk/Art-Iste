<?php

namespace App\Controller\Artisan;

use App\Services\Artisan\ArtisanService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtisanController extends AbstractController
{
    /**
     * @param int $id
     * @param ArtisanService $artisanService
     * @return Response
     * @Route("/artisan/{id}", name="show_artisan")
     */
    public function index(int $id, ArtisanService $artisanService): Response
    {

        $artisan = $artisanService->getArtisanById($id);

        if(!$artisan || !$artisan->getIsVerified()) {
            return $this->redirectToRoute("home");
        }



        return $this->render('artisan/index.html.twig', [
            'controller_name' => 'Artisan',
            'artisan' => $artisan
        ]);
    }
}
