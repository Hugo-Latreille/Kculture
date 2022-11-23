<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UsersFixtures extends Fixture
{

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public const USER_REFERENCE = 'user';
    public const USER2_REFERENCE = 'user2';
    public const ADMIN_REFERENCE = 'admin';

    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setEmail("test@test.com");
        $user1->setPseudo("Mateodu87");
        $hashedPassword = $this->passwordHasher->hashPassword($user1, 'test');
        $user1->setPassword($hashedPassword);
        $manager->persist($user1);
        $this->addReference(self::USER_REFERENCE, $user1);


        $user2 = new User();
        $user2->setEmail("hugo@test.com");
        $user2->setPseudo("HugoDu17");
        $hashedPassword = $this->passwordHasher->hashPassword($user2, 'hugo');
        $user2->setPassword($hashedPassword);
        $manager->persist($user2);
        $this->addReference(self::USER2_REFERENCE, $user2);


        $admin = new User();
        $admin->setEmail("admin@admin.com");
        $admin->setPseudo("admin");
        $hashedPassword = $this->passwordHasher->hashPassword($admin, 'admin');
        $admin->setPassword($hashedPassword);
        $manager->persist($admin);
        $this->addReference(self::ADMIN_REFERENCE, $admin);
        $manager->flush();
    }
}