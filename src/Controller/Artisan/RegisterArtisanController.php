<?php

namespace App\Controller\Artisan;

use App\Entity\Artisan;
use App\Form\RegisterArtisanType;
use App\Services\Artisan\ArtisanService;
use App\Services\Users\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterArtisanController extends AbstractController
{
    /**
     * @param Request $request
     * @param UserService $userService
     * @param ArtisanService $artisanService
     * @return Response
     * @Route("/register/artisan", name="register_artisan")
     */
    public function index(Request $request, UserService $userService, ArtisanService $artisanService): Response
    {

        if(!$this->getUser() || $artisanService->getArtisanByUserId($this->getUser()->getId()) !== null) {
            return $this->redirectToRoute("home");
        }

        $user = $userService->getUserByUsername($this->getUser()->getUsername());


        $artisan = new Artisan();
        $artisan_form = $this->createForm(RegisterArtisanType::class, $artisan);
        $artisan_form->handleRequest($request);

        if($artisan_form->isSubmitted() && $artisan_form->isValid()) {

                $artisanService->registerArtisan($user, $artisan);

                $this->addFlash('success', 'Votre demande a été soumise. Vous recevrez une notification par mail lors de la validation');
                return $this->redirectToRoute('home');

        }

        return $this->render('register_artisan/index.html.twig', [
            'controller_name' => 'Inscription pour professionnels',
            'artisan_form' => $artisan_form->createView()
        ]);
    }
}
