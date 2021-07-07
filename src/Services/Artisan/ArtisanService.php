<?php


namespace App\Services\Artisan;

use App\Entity\Artisan;
use App\Entity\ArtisansJob;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class ArtisanService
{

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    //Get Artisan object using id
    public function getArtisanById(int $id): object
    {
        return $this->em
            ->getRepository(Artisan::class)
            ->find($id);
    }

    //Get Artisan Object using userid
    public function getArtisanByUserId(int $userId): ?Artisan {
        return $this->em
            ->getRepository(Artisan::class)
            ->findOneBy(['user' => $userId]);
    }

    //Get all types of artisan job
    public function getAllArtisanCategories(): array {

        return $this->em
            ->getRepository(ArtisansJob::class)
            ->findAll();

    }

    //register a new Artisan
    public function registerArtisan(User $user, Artisan $artisan){

        $artisan
            ->setUser($user)
            ->setIsVerified(false)
            ->setVitrineName($user->getFirstName() . ' ' . $user->getLastName())
            ->setVitrineDesc('Voici la description de ma vitrine. Vous pouvez la changer depuis vos paramètres.')
            ->setCoverImage('default.png');

        $this->em->persist($artisan);
        $this->em->flush();

    }

}