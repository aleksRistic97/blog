<?php

namespace App\Service;

use App\Entity\User;
use App\Security\EmailVerifier;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordToken;
use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelper;
use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelperInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelper;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

class EmailService{

    private MailerInterface $mailer;
    private EmailVerifier $emailVerifier;
    private UrlGeneratorInterface $router;
   

    public function __construct(MailerInterface $mailer, EmailVerifier $emailVerifier, UrlGeneratorInterface $router){
       
           $this->mailer=$mailer;
           $this->emailVerifier=$emailVerifier;
           $this->router=$router;

    }

   public function sendEmail(string $to, string $subject, string $template, array $context=[]):void{

        $email=(new TemplatedEmail())->from(new Address('aleks.dragicevic97@gmail.com','admin'))
                                     ->to($to)
                                     ->subject($subject)
                                     ->htmlTemplate($template)
                                     ->context($context);

        $this->mailer->send($email);

   }

   public function sendVerificationEmail(User $user, string $verifyEmailRouteName): void
   {
        $context = $this->emailVerifier->generateEmailContext($verifyEmailRouteName, $user);

        $this->sendEmail(
        $user->getEmail(),
        'Please Confirm your Email',
        'registration/confirmation_email.html.twig',
        $context
    );
   }


   public function sendPasswordResetEmail(User $user, string $resetUrl): void
    {

      //  dd('Metoda pozvana');


     //   $context = $this->emailVerifier->generateEmailContext( $restPasswordRouteName, $user);
         $context = [
         'resetUrl' => $resetUrl,
         'user' => $user,
         ];
         
     //   dd($context); 
        
        $this->sendEmail(
            $user->getEmail(),
            'Password Reset Request',
            'reset_password/email.html.twig',
            $context
        );

    }

    public function sendWelcomeEmail(User $user): void
    {
        $context = [
            'user' => $user
        ];

        $this->sendEmail(
            $user->getEmail(),
            'Welcome!',
            'registration/welcome.html.twig',
            $context
        );
    }

    
}
