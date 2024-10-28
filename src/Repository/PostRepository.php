<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\ParameterType;
use Doctrine\Persistence\ManagerRegistry;
use function Symfony\Component\String\s;

/**
 * @extends ServiceEntityRepository<Post>
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function searchByCriteria($search, $date)
    {

        $sql = "SELECT * FROM post p WHERE 1=1";

        if ( $date != null) {

            $sql .= " AND p.created_at LIKE :date";

        }

        if ($search!=null )
        {
            $sql .= " AND (p.title LIKE :search OR p.description LIKE :search )";

        }

        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);

        if ($search != null) {

            $stmt->bindValue("search", '%' . $search . '%');

        }

        if ($date != null)
        {

            $date = $date->format('Y-m-d');

            $stmt->bindValue("date", $date . '%');

        }

       return $stmt->executeQuery()->fetchAllAssociative();
    }

}
