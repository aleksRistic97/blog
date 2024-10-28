<?php


namespace App\Provider;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Validator\Constraints\Uuid;

class OAuthUserProvider implements UserProviderInterface, OAuthAwareUserProviderInterface
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {

        $data=$response->getData();
        $email=$data['email'];

        $user=$this->entityManager->getRepository(User::class)->findOneBy(['email'=>$email]);

        if (!$user)
        {
            $user=new User();
            $user->setEmail($email);
            $user->setRoles(['ROLE_USER']);
            $user->setVerified(true);
            $verificationToken = \Symfony\Component\Uid\Uuid::v4()->toRfc4122();
            $user->setVerificationToken($verificationToken);

            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }

        return $user;
    }

    public function loadUserByUsername($username)
    {
        $user=$this->entityManager->getRepository(User::class)->findOneBy(['email'=>$username]);

        if (!$user)
        {
            throw new UserNotFoundException(sprintf("User '%s' not found.", $username)
            );
        }
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        // TODO: Implement refreshUser() method.
    }

    public function supportsClass(string $class): bool
    {
        // TODO: Implement supportsClass() method.
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        // TODO: Implement loadUserByIdentifier() method.
    }
}