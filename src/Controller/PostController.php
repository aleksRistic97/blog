<?php

namespace App\Controller;

use App\Entity\Attachment;
use App\Entity\Post;
use App\Form\PostFormType;
use App\Repository\PostRepository;
use App\Service\UploadService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;

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
      
        $repository=$this->em->getRepository(Post::class);
        $queryBuilder = $repository->createQueryBuilder('post');
       

        $pagination=$this->paginator->paginate($queryBuilder,
                            $request->query->getInt('page',1),
                            5);

        return $this->render('posts/index.html.twig', [
            'pagination'=>$pagination]);
    }

    #[Route('/posts/create', name: 'create_post')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function create(Request $request, UploadService $uploadService): Response
    {    
        $post=new Post();

        $form = $this->createForm(PostFormType::class, $post);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $attachmentsData = $request->files->get('post_form')['attachments'] ?? null;
        
            if ($attachmentsData) {
                foreach ($attachmentsData as $attachmentData) {
                    /**   @var UploadedFile $uploadedFile **/
                    $uploadedFile = $attachmentData['file'];
                
                    if($uploadedFile instanceof UploadedFile){
                        $attachment=$uploadService->uploadFile($uploadedFile, $this->em, $this->getUser());
                    }

                    $post->addAttachment($attachment); 
                }
            }

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
 
        $attachments=$post->getAttachments();

        return $this->render('posts/show.html.twig', [
            'post'=>$post,
            'attachments'=>$attachments
        ]);
    } 

    #[Route('/posts/update/{slug}', name: 'update_post')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function update(Request $request, $slug,  UploadService $uploadService):Response{

       $repository=$this->em->getRepository(Post::class);
       $post=$repository->findOneBy(['slug' => $slug]);
       
       $form=$this->createForm(PostFormType::class, $post);


       $form->handleRequest($request);
      
     
       if($form->isSubmitted() && $form->isValid()){

        $attachmentsData = $request->files->get('post_form')['attachments'] ?? null;
    
        if ($attachmentsData) {      
            foreach ($attachmentsData as $attachmentData) {
                /**   @var UploadedFile $uploadedFile **/
                $uploadedFile = $attachmentData['file'];
            
                if($uploadedFile instanceof UploadedFile){
                    $attachment=$uploadService->uploadFile($uploadedFile, $this->em, $this->getUser());

                }

                $post->addAttachment($attachment); 
            }
        }


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
  