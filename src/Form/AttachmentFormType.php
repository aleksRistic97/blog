<?php

    namespace App\Form;

    use App\Entity\Attachment;
    use App\Entity\Post;
    use App\Entity\User;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\FileType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Validator\Constraints\File;

    class AttachmentFormType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('file', FileType::class, [
                    'label' => 'Allowed types: JPEG, JPG, PNG, PDF',
                    'mapped'=>false,
                    'required' => false,
                    'constraints'=>[
                        new File([
                            'maxSize'=>'3M',
                            'mimeTypes'=>[
                                'application/pdf',
                                'image/jpg',
                                'image/jpeg',
                                'image/png',
                            ],
                            'mimeTypesMessage' => 'Please upload a valid type of attachment'
                        ]),
                    ],
                ]);  
        }

        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => null,
            ]);
        }
    }
