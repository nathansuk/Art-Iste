<?php

namespace App\Controller\Artisan;

use App\Entity\Artisan;
use App\Form\RegisterArtisanType;
use App\Services\Users\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterArtisanController extends AbstractController
{
    /**
     * @param Request $request
     * @param UserService $userService
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route("/register/artisan", name="register_artisan")
     */
    public function index(Request $request, UserService $userService, EntityManagerInterface $entityManager): Response
    {

        if(!$this->getUser()) {
            return $this->redirectToRoute("home");
        }

        $user = $userService->getUserByUsername($this->getUser()->getUsername());

        if($user->getArtisans() !== null){
            return $this->redirectToRoute("home");
        }

        $artisan = new Artisan();
        $artisan_form = $this->createForm(RegisterArtisanType::class, $artisan);
        $artisan_form->handleRequest($request);

        if($artisan_form->isSubmitted() && $artisan_form->isValid()) {

                $artisan->setUser($user)
                        ->setIsVerified(false)
                        ->setVitrineName($user->getFirstName() . ' ' . $user->getLastName())
                        ->setVitrineDesc('Voici la description de ma vitrine. Vous pourrez la changer depuis vos paramètres.')
                        ->setCoverImage('default.png');

                $entityManager->persist($artisan);
                $entityManager->flush();

                $this->addFlash('success', 'Votre demande a été soumise. Vous recevrez une notification par mail lors de la validation');
                return $this->redirectToRoute('home');

        }

        if ($artisan_form->isSubmitted() && !$artisan_form->isValid()){
            $this->addFlash('error', 'Il y a eu une erreur lors de la soumition du formulaire');
            return $this->redirectToRoute('artisan_register');
        }

        return $this->render('register_artisan/index.html.twig', [
            'controller_name' => 'Inscription pour professionnels',
            'artisan_form' => $artisan_form->createView()
        ]);
    }
}
