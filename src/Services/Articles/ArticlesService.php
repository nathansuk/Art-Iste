<?php


namespace App\Services\Articles;


use App\Entity\Articles;
use Doctrine\ORM\EntityManagerInterface;

class ArticlesService
{

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    //Get All article
    public function getAllArticle(): array {

        return $this->em
            ->getRepository(Articles::class)
            ->findAll();

    }

    //Get list of Article with a limit
    public function getListOfArticle(?int $limit): array {

        return $this->em
            ->getRepository(Articles::class)
            ->findBy(array(), ['postedAt' => 'DESC'], $limit);

    }

    //Get an Article using his id
    public function getArticleById(int $id): object {

        return $this->em
            ->getRepository(Articles::class)
            ->find($id);
    }

}