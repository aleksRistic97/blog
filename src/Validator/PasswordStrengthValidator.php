<?php

namespace App\Validator;

use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use UnexpectedValueException;

class PasswordStrengthValidator extends ConstraintValidator{

    public function validate(mixed $value, Constraint $constraint){
        
        if (!$constraint instanceof PasswordStrength) {
            throw new UnexpectedTypeException($constraint, PasswordStrength::class);
        }
      
      //  dump($value);
        if (null === $value || '' === $value) {
            return;
        }
      

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }


        if (!preg_match('/[A-Z]/', $value) || !preg_match('/[a-z]/', $value) ||
            !preg_match('/[0-9]/', $value) || !preg_match('/[\W]/', $value)) { 
        
            $this->context->buildViolation($constraint->message)
                          ->addViolation();
        }
    }
}