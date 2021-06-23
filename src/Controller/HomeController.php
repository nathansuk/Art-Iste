<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Artisan;
use App\Entity\ArtisansJob;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use MaxMind\Db\Reader\InvalidDatabaseException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @param Reader $reader
     * @return Response
     * @throws InvalidDatabaseException
     * @Route("/", name="home")
     */
    public function index(Reader $reader): Response
    {
        /*
         * This is used to get the user IP and his location.
         * The location is set as a string
         * Then we select artisans from database using the saved string.
         */
        try {
            $record = $reader->city('2a01:cb04:783:7900:c094:eab5:ad67:bb83');
        } catch (AddressNotFoundException $e) {

        }

        $articles = $this->getDoctrine()->getRepository(Articles::class)->findBy(array(), ['postedAt' => 'DESC'], '5');
        $artisanCategory = $this->getDoctrine()->getRepository(ArtisansJob::class)->findAll();
        $artisanList = $this->getDoctrine()->getRepository(Artisan::class)->findBy(["city" => $record->city->name]);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'Accueil',
            'articles' => $articles,
            'categories' => $artisanCategory,
            'artisanList' => $artisanList
        ]);
    }
}
