<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
      $post1=new Post();
      $post1->setTitle('Najpogodnije boje za vas dom');
      $post1->setDescription('Ovo je opis za clanak o izboru boja za dom.');
      $post1->setSlug('boje-za-dom');
      $post1->addTag($this->getReference('uredjenje_doma'));
      $post1->addTag($this->getReference('boje'));
      $post1->addTag($this->getReference('mali_prostori'));
      $post1->setCategory($this->getReference('boje_dekor'));
      $manager->persist($post1);
    
      $post2=new Post();
      $post2->setTitle('Feng shui uredjenje');
      $post2->setDescription('Ovo je opis za clanak o feng shui konceptu uredjenja.');
      $post2->setSlug('feng-za-shui');
      $post2->addTag($this->getReference('uredjenje_doma'));
      $post2->addTag($this->getReference('inspiracija'));
      $post2->addTag($this->getReference('skladistenje'));
      $post2->setCategory($this->getReference('namestaj'));
      $manager->persist($post2);

      $post3=new Post();
      $post3->setTitle('Saveti za uredjenje baste');
      $post3->setDescription('Ovo je opis za clanak o uredjenju baste.');
      $post3->setSlug('uredjenje-baste');
      $post3->addTag($this->getReference('inspiracija'));
      $post3->addTag($this->getReference('bastansko_cvece'));
      $post3->setCategory($this->getReference('basta'));
      $manager->persist($post3);
    
      $manager->flush();
    }
    

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            TagFixtures::class,
        ];
    }
}