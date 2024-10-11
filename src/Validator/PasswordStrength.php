<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\PasswordStrengthValidator;

#[\Attribute]
class PasswordStrength extends Constraint{

    public string $message='password_constraint';


    public function __construct(array $options, ?array $groups=null, $payload=null){

        parent::__construct($options, $groups, $payload);
        
        if (isset($options['message'])) {
            $this->message = $options['message'];
        }
    }

    public function validatedBy(): string
    {   
        return 'App\Validator\PasswordStrengthValidator';
    }
                        
    public function getTargets(): string
    {
        return self::PROPERTY_CONSTRAINT; 
    }
}