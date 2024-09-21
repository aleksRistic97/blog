<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $tag=new Tag();
        $tag->setTitle("uredjenje doma");
        $tag->setSlug('uredjenje-doma');
        $manager->persist($tag);
       

        $tag2=new Tag();
        $tag2->setTitle("boje");
        $tag2->setSlug('boje');
        $manager->persist($tag2);
        

        $tag3=new Tag();
        $tag3->setTitle("inspiracija");
        $tag3->setSlug('inspiracija');
        $manager->persist($tag3);
        

        $tag4=new Tag();
        $tag4->setTitle("skladistenje");
        $tag4->setSlug('skladistenje');
        $manager->persist($tag4);
        
        $tag5=new Tag();
        $tag5->setTitle("mali prostori");
        $tag5->setSlug('mali-prostori');
        $manager->persist($tag5);
        


        $tag6=new Tag();
        $tag6->setTitle("bastansko cvece");
        $tag6->setSlug('bastansko-cvece');
        $manager->persist($tag6);      
        
        $this->addReference('uredjenje_doma', $tag);
        $this->addReference('boje', $tag2);
        $this->addReference('inspiracija', $tag3);
        $this->addReference('skladistenje', $tag4);
        $this->addReference('mali_prostori', $tag5);
        $this->addReference('bastansko_cvece', $tag6);
        

        $manager->flush();

        




        
    }
}