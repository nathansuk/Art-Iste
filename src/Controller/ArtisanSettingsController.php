<?php

namespace App\Controller;

use App\Entity\ArtisanPhotos;
use App\Form\ArtisanSettingsType;
use App\Form\BookPhotoType;
use App\Services\Artisan\ArtisanService;
use App\Services\Users\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtisanSettingsController extends AbstractController
{
    /**
     * @param int $id
     * @param UserService $userService
     * @param ArtisanService $artisanService
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route("/settings/artisan/{id}", name="artisan_general_settings")
     */
    public function index(int $id, UserService $userService, ArtisanService $artisanService, Request $request, EntityManagerInterface $entityManager): Response
    {
        $artisan = $artisanService->getArtisanById($id);
        $user = $userService->getUserByUsername($this->getUser()->getUsername());

        if(!$artisan){
             return $this->redirectToRoute("home");
        }

        if($artisan->getUser()->getId() !== $user->getId()){
            return $this->redirectToRoute("home");
        }

        $artisanSettingsForm = $this->createForm(ArtisanSettingsType::class, $artisan);
        $artisanSettingsForm->handleRequest($request);

        if($artisanSettingsForm->isSubmitted() && $artisanSettingsForm->isValid()) {

            if($artisanSettingsForm->get('cover_image')->getData() !== null){

                $image = $artisanSettingsForm->get('cover_image')->getData();
                $file = md5(uniqid()).'.'.$image->guessExtension();
                $image->move($this->getParameter('artisan_cover'), $file);
                $artisan->setCoverName($file);
                $artisan->setUpdatedAt(new \DateTime("now"));

            }


            $entityManager->persist($artisan);
            $entityManager->flush();

            $this->addFlash('success', 'Les paramètres ont bien été modifiés !');

        }

        return $this->render('artisan_settings/index.html.twig', [
            'controller_name' => 'Paramètres de ma vitrine',
            'artisanSettingsForm' => $artisanSettingsForm->createView()
        ]);
    }


    /**
     * @param int $id
     * @param UserService $userService
     * @param ArtisanService $artisanService
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route("/settings/artisan/{id}/photos/", name="book_add_photos")
     */
    public function manageBookPhotos(int $id, UserService $userService, ArtisanService $artisanService, Request $request, EntityManagerInterface $entityManager): Response
    {
        $artisan = $artisanService->getArtisanById($id);
        $user = $userService->getUserByUsername($this->getUser()->getUsername());

        $photo = new ArtisanPhotos();

        if(!$artisan){
            $this->redirectToRoute("home");
        }

        if($artisan->getUser()->getId() !== $user->getId()){
            $this->redirectToRoute("home");
        }

        $addPhotoForm = $this->createForm(BookPhotoType::class, $photo);
        $addPhotoForm->handleRequest($request);

        if($addPhotoForm->isSubmitted() && $addPhotoForm->isValid()) {

                $image = $addPhotoForm->get('imageName')->getData();
                $file = md5(uniqid()).'.'.$image->guessExtension();
                $image->move($this->getParameter('book_photo'), $file);

                $photo
                    ->setArtisan($artisan)
                    ->setImageName($file)
                    ->setValid(false);


            $entityManager->persist($photo);
            $entityManager->flush();

            $this->addFlash('success', 'La photo a bien été ajoutée à votre book photo.');

        }

        return $this->render('artisan_settings/photos.html.twig', [
            'controller_name' => 'Ajouter une photo au book photo',
            'addPhotoForm' => $addPhotoForm->createView()
        ]);
    }

    /**
     * @Route("/settings/artisan/{id}/photolist/", name="list_book_photo")
     * @param int $id
     * @param UserService $userService
     * @param ArtisanService $artisanService
     * @return Response
     */
    public function listPhotos(int $id, UserService $userService, ArtisanService $artisanService): Response {

        $artisan = $artisanService->getArtisanById($id);
        $user = $userService->getUserByUsername($this->getUser()->getUsername());

        if(!$artisan){
            return $this->redirectToRoute("home");
        }

        if($artisan->getUser()->getId() !== $user->getId()){
            return $this->redirectToRoute("home");
        }

        $photos = $this->getDoctrine()->getRepository(ArtisanPhotos::class)->findBy(['artisan' => $artisan->getId()]);

        return $this->render('artisan_settings/listphotos.html.twig', [
            'controller_name' => 'Mon book photo',
            'listPhotos' => $photos
        ]);

    }
}
