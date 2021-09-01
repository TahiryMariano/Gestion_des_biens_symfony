<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UtilisateurFixturs extends Fixture
{
    private $passwordHasher;
    
    public function __construct(UserPassWordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager)
    {
        $utilisateur = new Utilisateur();
        $utilisateur->setUsername('test')
            ->setPassword($this->passwordHasher->hashPassword($utilisateur,'test'));
        $manager->persist($utilisateur);

        $manager->flush();
    }
}
