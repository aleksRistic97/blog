<?php

namespace App\Service;

use App\Entity\Attachment;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploadService{
    private SluggerInterface $slugger;
    private string $uploadsDirectory;

    public function __construct(SluggerInterface $slugger, string $uploadsDirectory){
        $this->slugger=$slugger;
        $this->uploadsDirectory=$uploadsDirectory;
    }

    public function uploadFile(UploadedFile $uploadedFile, EntityManagerInterface $em, User $user): Attachment{

        
        $fileName=pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $slug=$this->slugger->slug($fileName);
        $newFileName=$slug.'-'.uniqid().'.'.$uploadedFile->guessExtension();
        
        try{
            $uploadedFile->move( $this->uploadsDirectory, $newFileName);
        } catch (FileException $ex){
            error_log($ex->getMessage());
        }

        $attachment=new Attachment();
        $attachment->setOriginalFileName($uploadedFile->getClientOriginalName());
        $attachment->setFileName( $newFileName);
        $attachment->setSlug($slug);
        $attachment->setPath($this->uploadsDirectory.'/'.$newFileName);
        $attachment->setUploadedBy($user);

        $em->persist($attachment);

        return $attachment;
    }
}