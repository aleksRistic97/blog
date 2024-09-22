<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PostController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em){
        $this->em=$em;
    }

    #[Route('/posts', methods:['GET'], name: 'posts')]
    public function index(): Response
    {
        
        $repository=$this->em->getRepository(Post::class);
        $posts=$repository->findAll();

    //    dd($posts);

        return $this->render('index.html.twig', [
            'posts'=>$posts
        ]
    );
    }
}
  