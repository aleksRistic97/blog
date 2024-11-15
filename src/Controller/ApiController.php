<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\ApiPostFormType;
use App\Form\PostFormType;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

class ApiController extends AbstractController
{

    #[Route('/api/posts/{slug}', name: 'api_get_posts', defaults: ['slug'=>null], methods: ['GET'])]
    public function index(?string $slug, PostRepository $postRepository, SerializerInterface $serializer): JsonResponse
    {

        $posts = $slug ? $postRepository->findOneBy(['slug'=>$slug]) : $postRepository->findAll();

        if (!$posts)
        {

            return new JsonResponse(['message'=>'no posts found'], Response::HTTP_NOT_FOUND);
        }

        $data=$serializer->serialize($posts,'json',['groups'=>['post_list','read']]);

        return new JsonResponse($data,Response::HTTP_OK,[],true);

    }

    #[Route('/api/post/create', name: 'api_post_create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): JsonResponse
    {

        $data = $request->getContent();
        $data = json_decode($data,true);

        if( $data === null)
        {

            return new JsonResponse(['message'=>'Insert parameters'],Response::HTTP_BAD_REQUEST);

        }

        $post = new Post();
        $post->setCreatedAt(new \DateTimeImmutable());

        $form = $this->createForm(ApiPostFormType::class, $post);
        $form->submit($data);

        if ($form->isSubmitted())
        {

            if ($form->isValid())
            {

                $em->persist($post);
                $em->flush();

                $data=$serializer->serialize($post,'json',['groups'=>['post_list','read']]);

                return new JsonResponse($data,Response::HTTP_OK,[],true);
            }
            else
            {

                $errors = [];
                foreach ($form->getErrors(true) as $error) {
                    $errors[] = [
                        'message' => $error->getMessage(),
                    ];
                }
                return new JsonResponse(['message' => 'Invalid form data', 'errors' => $errors], Response::HTTP_BAD_REQUEST);
            }
        }

        return new JsonResponse(['message'=>'Invalid form data'], Response::HTTP_BAD_REQUEST);
    }

    #[Route('/api/post/update', name: 'api_post_update', methods: ['PUT'])]
    public function update(Request $request, EntityManagerInterface $em, PostRepository $postRepository,
                            SerializerInterface $serializer) : JsonResponse
    {

        $data = $request->getContent();
        $data = json_decode($data,true);

        $slug = filter_input(INPUT_GET,'slug',FILTER_SANITIZE_URL);

        $post = $postRepository->findOneBy(['slug'=>$slug]);

        $form = $this->createForm(ApiPostFormType::class, $post);
        $form->submit($data, false);
 
        if ($form->isSubmitted())
        {
            if ($form->isValid())
            {

                $em->persist($post);
                $em->flush();
                $data=$serializer->serialize($post,'json',['groups'=>['post_list','read']]);

                return new JsonResponse($data,Response::HTTP_OK,[],true);
            }
            else
            {

                $errors = [];
                foreach ($form->getErrors(true) as $error)
                {
                    $errors[] = [
                        'field' => $error->getOrigin()->getName(),
                        'message' => $error->getMessage(),
                    ];
                }
                return new JsonResponse(['message' => 'Invalid form data', 'errors' => $errors], Response::HTTP_BAD_REQUEST);
            }
        }

        return new JsonResponse(['message'=>'Cannot update post'], Response::HTTP_BAD_REQUEST);
    }

    #[Route('/api/post/delete', name: 'api_post_delete', methods: ['DELETE'])]
    public function delete(Request $request, EntityManagerInterface $em) : JsonResponse
    {

        $data= $request->getContent();
        $data = json_decode($data,true);
        $slug = $data['slug'] ?: null;

        $post = $slug ? $em->getRepository(Post::class)->findOneBy(['slug'=>$slug]) : null;

        if (!$post)
        {

            return new JsonResponse(['message'=>'No post found'], Response::HTTP_NOT_FOUND);
        }

        $em->remove($post);
        $em->flush();
        return new JsonResponse(['message'=>'Post deleted']);
    }

}

