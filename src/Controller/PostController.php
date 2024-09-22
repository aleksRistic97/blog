<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostFormType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

        return $this->render('posts/index.html.twig', [
            'posts'=>$posts]);
    }

    #[Route('/posts/create', name: 'create_post')]

    public function create(Request $request): Response
    {
       // $selectedCategory=101;

        $post=new Post();

        $form = $this->createForm(PostFormType::class, $post);

      $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()){
           
            $this->em->persist($post);
            $this->em->flush();

            return $this->redirectToRoute('posts');
        } 

        return $this->render('posts/create.html.twig', [
            'form' => $form->createView()
        ]);

    }
     #[Route('/posts/{id}', methods:['GET'], name: 'show_post')]
    public function show($id): Response
    {
        
        $repository=$this->em->getRepository(Post::class);
        $post=$repository->find($id);
    //    dd($posts);

        return $this->render('posts/show.html.twig', [
            'post'=>$post]);
    } 

    #[Route('/posts/update/{id}', name: 'update_post')]

    public function update(Request $request, $id):Response{

       $repository=$this->em->getRepository(Post::class);
       $post=$repository->find($id);

       $form=$this->createForm(PostFormType::class, $post);

       $form->handleRequest($request);

       if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($post);
            $this->em->flush();

         return $this->redirectToRoute('posts');
       }
       
       return $this->render('posts/update.html.twig',[
        'post'=>$post,
        'form'=>$form->createView()
       ]);
    }
}
  