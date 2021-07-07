<?php


namespace App\Services\Users;

use App\Entity\User;
use App\Entity\UserSettings;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function getUserByUsername(string $username): ?User
    {
        return $this->em
            ->getRepository(User::class)
            ->findOneBy(['email' => $username]);
    }

    /*
     * This function registers a new user and creates new settings.
     */
    public function registerUser(User $user, string $hash) {

        $user
            ->setPassword($hash)
            ->setRegisterDate(new \DateTime("now"))
            ->setRoles(["ROLE_USER"])
            ->setIsPro(false);

        $settings = new UserSettings();
        $settings
            ->setUser($user)
            ->setImageName('default.jpeg');

        $this->em->persist($user);
        $this->em->persist($settings);
        $this->em->flush();
    }

}