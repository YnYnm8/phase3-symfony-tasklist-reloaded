<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Priority;
use App\Entity\User;
use App\Entity\Folder;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $priorities = [
            ['name' => 'urgent', 'importance' => 1],
            ['name' => 'important', 'importance' => 2],
            ['name' => 'normal', 'importance' => 3],
        ];

        foreach ($priorities as $data) {
            $priority = new Priority();
            $priority->setName($data['name']);
            $priority->setImportance($data['importance']);
            $manager->persist($priority);
        }
        // Folder（Userが必要なのでUserも作る）
        $user = new User();
        $user->setEmail('test@test.com');
        $user->setUsername('testuser');
        $user->setPassword('password');
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);

        $folders = ['Travail', 'Maison', 'Personnel'];
        foreach ($folders as $name) {
            $folder = new Folder();
            $folder->setName($name);
            $folder->setUser($user);
            $manager->persist($folder);
        }
        $manager->flush();
    }
}
