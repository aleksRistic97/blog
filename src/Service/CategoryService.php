<?php

namespace App\Service;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;

class CategoryService {
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {

        $this->em = $em;
    }

    public function getCategories()
    {

        return $this->em->getRepository(Category::class)->findAll();
    }
}