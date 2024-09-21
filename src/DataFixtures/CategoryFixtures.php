<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $category1=new Category();
        $category1->setTitle('Untrasnje uredjenje');
        $category1->setSlug('enterijer');
        $category1->setCategory(null);
        $manager->persist($category1);
       
        $category2=new Category();
        $category2->setTitle('Uredjenje spoljasnjeg prostora');
        $category2->setSlug('eksterijer');
        $category2->setCategory(null);
        $manager->persist($category2);
        
        $category3=new Category();
        $category3->setTitle('Boje i dekor');
        $category3->setSlug('boje-i-dekor');
        $category3->setCategory($category1);

        $manager->persist($category3);
      
        $category4=new Category();
        $category4->setTitle('Namestaj');
        $category4->setSlug('namestaj');
        $category4->setCategory($category1);

        $manager->persist($category4);
        
        $category5=new Category();
        $category5->setTitle('Basta');
        $category5->setSlug('basta');
        $category5->setCategory($category2);
        $manager->persist($category5);       
       
        $this->addReference('enterijer', $category1);
        $this->addReference('eksterijer', $category2);
        $this->addReference('boje_dekor', $category3);
        $this->addReference('namestaj', $category4);
        $this->addReference('basta', $category5);
        
        $manager->flush();

       

    }
}