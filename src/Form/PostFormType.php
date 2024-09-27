<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\Tag;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //$selectedCategory=$options['selected_category'];

        $builder
            ->add('title')
            ->add('description', TextType::class,[
                'attr' => [
                'id'=>'description'
                ]
            ])
            ->add('slug')
            ->add('tags', EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'title',
                'multiple' => true,
            ])
     
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => function (Category $category) {
                    return $category->getCategory() ?
                        $category->getCategory()->getTitle() . ' - ' . $category->getTitle()
                        : $category->getTitle();
                    
                },
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                    ->where('c.category IS NOT NULL');
                }
            ]); 

           
        }
    
    
        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
                'data_class' => Post::class,
            ]);
        }
    
}
