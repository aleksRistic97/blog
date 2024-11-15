<?php

namespace App\Form;


use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApiPostFormType extends PostFormType
{

    public function configureOptions(OptionsResolver $resolver)
    {

        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'csrf_protection' => false
        ]);


    }
}