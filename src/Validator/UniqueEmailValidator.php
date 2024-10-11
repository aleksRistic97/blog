<?php

namespace App\Validator;

use App\Repository\UserRepository;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Contracts\Translation\TranslatorInterface;
use UnexpectedValueException;

class UniqueEmailValidator extends ConstraintValidator{

    private UserRepository $userRepository;
    private TranslatorInterface $translator;

    public function __construct(UserRepository $userRepository, TranslatorInterface $translator){
        $this->userRepository=$userRepository;
        $this->translator=$translator;
    }

    public function validate(mixed $value, Constraint $constraint){
       
        if (!$constraint instanceof UniqueEmail) {
            throw new UnexpectedTypeException($constraint, UniqueEmail::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        $user=$this->userRepository->findOneBy(['email'=>$value]);

        if($user){
            $this->context->buildViolation($this->translator->trans($constraint->message,))
            ->setParameter('{{ value }}', $value)
            ->addViolation();
        }
    }
}