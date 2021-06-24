<?php

namespace App\Controller;

use App\Form\UserSettingsType;
use App\Services\Users\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserSettingsController extends AbstractController
{
    /**
     * @param UserService $userService
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route("/settings", name="user_settings")
     */
    public function index(UserService $userService, Request $request, EntityManagerInterface $entityManager): Response
    {
        if(!$this->getUser()) {
            return $this->redirectToRoute("home");
        }

        $user = $userService->getUserByUsername($this->getUser()->getUsername());

        $settings = $user->getUserSettings();

        $form = $this->createForm(UserSettingsType::class, $settings);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if($form->get('imageName')->getData() !== null) {

                $image = $form->get('imageName')->getData();
                $file = md5(uniqid()) . '.' . $image->guessExtension();
                $image->move($this->getParameter('profile_pics'), $file);

                $settings->setImageName($file);
                $settings->setUpdatedAt(new \DateTime("now"));

                $entityManager->persist($settings);
                $entityManager->flush();

                $this->addFlash('success', 'Vos paramètres ont bien été modifiés.');

            }

        }


        return $this->render('user_settings/index.html.twig', [
            'controller_name' => 'Paramètres utilisateur',
            'userSettingsForm' => $form->createView()
        ]);
    }
}
