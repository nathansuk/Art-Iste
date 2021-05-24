<?php


namespace App\Services\Users;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function getUserByUsername(string $username): ?User {
        return $this->em->getRepository(User::class)->findOneBy(['email' => $username]);
    }

}