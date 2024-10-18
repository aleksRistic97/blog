<?php
namespace App\Controller;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\EmailService;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use Symfony\Component\Uid\Uuid;
class RegistrationController extends AbstractController
{
    private EmailService $emailService;

    public function __construct(private EmailVerifier $emailVerifier, EmailService $emailService)
    {

        $this->emailService=$emailService;
    
    }


    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, 
                            EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $user = new User();

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
           
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();
         
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));
            $user->setRoles(['ROLE_USER']);

            $verificationToken = Uuid::v4()->toRfc4122(); 
            $user->setVerificationToken($verificationToken);
           
            $entityManager->persist($user);
            $entityManager->flush();
  
           $session->set('registration_completed', true);

            $this->emailService->sendVerificationEmail($user, 'app_verify_email');
            

            return $this->redirectToRoute('verify_pending');
        }
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView()
        ]);
    }
    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, UserRepository $userRepository): Response
    {


        $id = $request->query->get('id');
        if (null === $id) {
            return $this->redirectToRoute('app_register');
        }
        $user = $userRepository->find($id);
        if (null === $user) {
            return $this->redirectToRoute('app_register');
        }

        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
            $this->emailService->sendWelcomeEmail($user);
        

        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());
            return $this->redirectToRoute('app_register');
        }
        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');
        return $this->redirectToRoute('posts');
    }
    #[Route('/verify_pending', name: 'verify_pending')]
    public function verifyPending(SessionInterface $session):Response{
        if (!$session->get('registration_completed')) {
            $this->addFlash('error', 'You must complete registration before accessing this page.');
            return $this->redirectToRoute('app_register');
        }

        $session->remove('registration_completed');
        return $this->render('registration/verify_email.html.twig');
    }
}