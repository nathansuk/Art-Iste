<?php


namespace App\Services\Artisan;

use App\Entity\Artisan;
use Doctrine\ORM\EntityManagerInterface;

class ArtisanService
{

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function getArtisanById(int $id): ?Artisan {
        return $this->em->getRepository(Artisan::class)->find($id);
    }

}