<?php

namespace App\Controller;

use App\Entity\Attachment;
use App\Entity\Comment;
use App\Entity\Post;
use App\Form\CommentFormType;
use App\Form\PostFormType;
use App\Form\SearchFormType;
use App\Repository\PostRepository;
use App\Service\UploadService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
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

    #[Route('/posts', methods:['GET', 'POST'], name: 'posts')]
    public function index(Request $request): Response
    {

        $repository=$this->em->getRepository(Post::class);
        $queryBuilder = $repository->createQueryBuilder('post');

        $form=$this->createForm(SearchFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

            $criteria=$form->getNormData();

            $search=$criteria['search'] ? $criteria['search'] : null;
            $date=$criteria['date'] ? $criteria['date'] : null;


            $queryBuilder = $repository->searchByCriteria($search, $date);

        }

        $pagination=$this->paginator->paginate($queryBuilder,
            $request->query->getInt('page',1),
            5);


        return $this->render('posts/index.html.twig', [
            'pagination'=>$pagination,
            'searchForm'=>$form->createView(),]);

    }

    #[Route('/posts/update/{slug}', name: 'update_post', defaults: ['slug' => null])]

    public function update(Request $request, $slug,  UploadService $uploadService):Response
    {


       if (!$slug) 
       {
            $post=new Post();
       }
       else
       {

            $repository=$this->em->getRepository(Post::class);
            $post=$repository->findOneBy(['slug' => $slug]);
        
        }
     
       
       $form=$this->createForm(PostFormType::class, $post);


       $form->handleRequest($request);
      
     
       if($form->isSubmitted() && $form->isValid())
       {

        $attachmentsData = $request->files->get('post_form')['attachments'] ?? null;
    
            if ($attachmentsData)
            {      
                foreach ($attachmentsData as $attachmentData)
                {
                    /**   @var UploadedFile $uploadedFile **/
                    $uploadedFile = $attachmentData['file'];
                
                    if($uploadedFile instanceof UploadedFile)
                    {
                    
                        $attachment=$uploadService->uploadFile($uploadedFile, $this->em, $this->getUser());

                    }

                    $post->addAttachment($attachment); 
                }
            }

            $post->setCreatedAt(new \DateTimeImmutable());


            $this->em->persist($post);
            $this->em->flush();

         return $this->redirectToRoute('posts');
       }
       
       return $this->render('posts/update.html.twig',[
        'post'=>$post,
        'form'=>$form->createView(),
        'edit'=> $slug!=null
       ]);

        
    }

    #[Route('/posts/addComment/{slug}/{id}', name: 'add_comment', defaults: ['id' => null])]

    public function addComment($slug, $id, Request $request, UploadService $uploadService):Response
    {

        if (!$this->isGranted('IS_AUTHENTICATED_FULLY'))
        {

            return $this->redirectToRoute(route: 'app_login');
        }

        $repository=$this->em->getRepository(Post::class);
        $post=$repository->findOneBy(['slug' => $slug]);

        $user=$this->getUser();

        $newComment = new Comment();
        $commentForm=$this->createForm(CommentFormType::class, $newComment);
        $commentForm->handleRequest($request);

        $newComment->setPost($post);
        $newComment->setAuthor($user);

        if($id){
            $repository=$this->em->getRepository(Comment::class);
            $comment=$repository->findOneBy(['id' => $id]);
            $newComment->setParent($comment);
        }


        if($commentForm->isSubmitted() && $commentForm->isValid())
        {

            $this->em->persist($newComment);
            $this->em->flush();

            return $this->redirectToRoute('show_post',  [
                'slug'=>$slug
            ]);

        }


        return $this->render('posts/addComment.html.twig',[
            'slug'=>$slug,
            'commentForm'=>$commentForm->createView(),
        ]);
    }

    #[Route('/posts/{slug}', name: 'show_post', methods: ['GET', 'POST'])]
    public function show($slug, EntityManagerInterface $em, Request $request, Security $security): Response
    {
        
        $repository=$this->em->getRepository(Post::class);
        $post=$repository->findOneBy(['slug' => $slug]);

        $attachments = $post->getAttachments();

        $repository1=$this->em->getRepository(Comment::class);

        $queryBuilder = $repository1->createQueryBuilder('comment')
                                    ->where('comment.post = :post')
                                    ->andWhere('comment.parent IS NULL')
                                    ->setParameter('post', $post)
                                    ->orderBy('comment.id', 'DESC')
                                    ->getQuery();


        $pagination=$this->paginator->paginate($queryBuilder,
            $request->query->getInt('page',1),
            4);

    //    dd($pagination);
        return $this->render('posts/show.html.twig', [
            'post'=>$post,
            'attachments'=>$attachments,
            'pagination'=>$pagination
        ]);
    }


    
}
  