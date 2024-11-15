<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\ParameterType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use function Symfony\Component\String\s;

/**
 * @extends ServiceEntityRepository<Post>
 *
 * @method Post[] findAll()
 */
class PostRepository extends ServiceEntityRepository
{

    private EntityManagerInterface $em;
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $em)
    {
        parent::__construct($registry, Post::class);
        $this->em = $em;
    }

    public function searchByCriteria($parameters, $categorySlug)
    {


        $queryBuilder = $this->createQueryBuilder('p')
                             ->join('p.category', 'c')
                             ->where("1=1");

        if ($categorySlug != null)
        {
            $category = $this->em->getRepository(Category::class)->findOneBy(['slug' => $categorySlug]);

            if ($category != null && $category->getCategory() === null)
            {

                $subcategories = $this->em->getRepository(category::class)->findBy(['category' => $category]);
                $subcategoryIds = [];

                foreach ($subcategories as $subcategory)
                {

                    $subcategoryIds []= $subcategory->getId();
                }

                $queryBuilder-> andWhere('c.id IN (:category)')
                    ->setParameter('category', $subcategoryIds);

            }
            else
            {

                $queryBuilder->andWhere('c.slug = :slug')
                    ->setParameter('slug', $categorySlug);
            }


        }

        foreach ($parameters as $key => $value)
        {

            if ($value != null)
            {

                switch ($key)
                {

                    case 'search':
                        $search = $parameters['search'];
                        $queryBuilder->andWhere('p.title LIKE :search')
                            ->orWhere('p.description LIKE :search')
                            ->setParameter('search', '%'.$search.'%');
                            break;
                    case 'date':
                        $date = $parameters['date'];
                        $queryBuilder->andWhere('p.createdAt LIKE :date')
                            ->setParameter('date', $date.'%');
                        break;
                }
            }
        }

        return $queryBuilder;
    }
}

