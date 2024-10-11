<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class UniqueEmail extends Constraint{
    
    public string $message='This "{{ value }}" already existis';

    public function __construct(array $options, ?array $groups=null, $payload=null){
        
        parent::__construct($options, $groups, $payload);
        
        if (isset($options['message'])) {
            $this->message = $options['message'];
        }
        

    }

    public function validatedBy(): string
    {
        return static::class.'Validator';
    }   
    
    public function getTargets(): string
    {
        return self::PROPERTY_CONSTRAINT;
    }

}