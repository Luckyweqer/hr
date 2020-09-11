<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Summary;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    const CATEGORIES = 10;
    const SUB_CATEGORIES = 50;
    const SUMMARIES = 100;

    public function load(ObjectManager $manager)
    {
        $user = new User;
        $user->setEmail('admin@admin.com');
        $user->setPlainPassword('123qwe');
        $user->setIsActive(true);
        $user->setRole('ROLE_USER');
        $manager->persist($user);
        $categories = [];

        for ($i = 0; $i <= self::CATEGORIES; $i++) {
            $category = new Category();
            $category->setName('category' . $i);
            $categories[] = $category;
            $manager->persist($category);
        }

        for ($i = 0; $i <= self::SUB_CATEGORIES; $i++) {
            $category = new Category();
            $category->setName('category' . $i);
            $category->setCategory($categories[random_int(0, self::CATEGORIES)]);
            $manager->persist($category);
            $subCategories[] = $category;
        }
        $allCategories = array_merge($subCategories, $categories);
        $allCategoriesCount = self::CATEGORIES + self::SUB_CATEGORIES;
        for ($i = 0; $i <= self::SUMMARIES; $i++) {
            $summary = new Summary();
            $summary->setLastName('Тестов' . $i);
            $summary->setFirstName('Тест' . $i);
            $summary->setPatronymic('Тестович' . $i);
            $summary->setSalary(random_int(200, 5000));

            $timestamp = mt_rand(1, time());
            $summary->setInterviewDate(new \DateTime(date("d M Y", $timestamp)));
            $summary->setComment('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');
            $summary->setCategory($allCategories[random_int(0, $allCategoriesCount)]);
            $manager->persist($summary);
        }
        $manager->flush();
    }
}
