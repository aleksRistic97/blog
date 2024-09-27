<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostFormType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class PostController extends AbstractController
{
    private $em;
    private PaginatorInterface $paginator;

    public function __construct(EntityManagerInterface $em, PaginatorInterface $paginator){
        $this->em=$em;
        $this->paginator=$paginator;
    }

    #[Route('/posts', methods:['GET'], name: 'posts')]
    public function index(Request $request): Response
    {
        // FIXME IMPLEMENT PAGINATOR
        $repository=$this->em->getRepository(Post::class);
        $queryBuilder = $repository->createQueryBuilder('post');
       

        $pagination=$this->paginator->paginate($queryBuilder,
        $request->query->getInt('page',1),
        20);

       //dd($pagination);
    //    dd($posts);

        return $this->render('posts/index.html.twig', [
            'pagination'=>$pagination]);
    }

    #[Route('/posts/create', name: 'create_post')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
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
            'form' => $form->createView(),
        ]);

    }
     #[Route('/posts/{slug}', methods:['GET'], name: 'show_post')]
    public function show($slug): Response
    {
        
        $repository=$this->em->getRepository(Post::class);
        $post=$repository->findOneBy(['slug' => $slug]);
      //  dd($post);

        return $this->render('posts/show.html.twig', [
            'post'=>$post]);
    } 

    #[Route('/posts/update/{slug}', name: 'update_post')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function update(Request $request, $slug):Response{

       $repository=$this->em->getRepository(Post::class);
       $post=$repository->findOneBy(['slug' => $slug]);
       
       $form=$this->createForm(PostFormType::class, $post);


       $form->handleRequest($request);
   
     
       if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($post);
            $this->em->flush();

         return $this->redirectToRoute('posts');
       }
       
       return $this->render('posts/update.html.twig',[
        'post'=>$post,
        'form'=>$form->createView(),
        'disabled'=>true
       ]);
    }
}
  