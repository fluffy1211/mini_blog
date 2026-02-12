<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher) {

    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('admin@example.com');
        $admin->setFirstName('Admin'); $admin->setLastName('User');
        $admin->setCreatedAt(new \DateTimeImmutable());
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'adminpass'));
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);
        $this->addReference('admin-user', $admin);

        for ($i=1; $i < 5; $i++) { 
            $user = new User();
            $user->setEmail("user$i@example.com");
            $user->setFirstName("User$i");
            $user->setLastName("Test$i");
            $user->setCreatedAt(new \DateTimeImmutable());
            $user->setPassword($this->passwordHasher->hashPassword($user, "userpass$i"));
            $manager->persist($user);
            $this->addReference("user-$i", $user);
        }
        
        $manager->flush();
    }
}
