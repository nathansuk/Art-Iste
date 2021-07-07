<?php


namespace App\Services\Artisan;


use App\Entity\Artisan;
use Doctrine\ORM\EntityManagerInterface;

class FindArtisanService
{

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function findArtisan(int $category, string $city, int $atArtisansHome): array {

        if($atArtisansHome == 1) {
            return $this->em
                ->getRepository(Artisan::class)
                ->findBy([
                    'category' => $category,
                    'city' => $city,
                    'atHome' => true
                ]);
        }

        if ($atArtisansHome == 0) {
            return $this->em
                ->getRepository(Artisan::class)
                ->findBy([
                    'category' => $category,
                    'city' => $city,
                    'canMove' => true
                ]);
        }

    }

}