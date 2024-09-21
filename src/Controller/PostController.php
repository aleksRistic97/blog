<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PostController extends AbstractController
{
    #[Route('/posts', methods:['GET'], name: 'posts')]
    public function index(): Response
    {
        return $this->render('index.html.twig',[
            'title'=>'Caoo'
        ]);
    }
}
 