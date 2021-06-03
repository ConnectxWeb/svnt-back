<?php

namespace App\Tests;


use App\Entity\Categorie;
use App\Entity\SousCategorie;


class CategoryTest extends UnitBase
{
    const DELETE_ALL = true;

    public function testDelete()
    {
        if (!self::DELETE_ALL) {
            $this->assertTrue(true);

            return;
        }

        //delete sub category
        $items = $this->repoService->getSousCategorieRepository()->findAll();
        foreach ($items as $item) {
            $this->pushMessage(sprintf('Delete sub-category: %s', $item->getNom()));
            $this->entityManager->remove($item);
        }
        $this->entityManager->flush();
        $this->pushMessage('-------------------');

        //delete category
        $items = $this->repoService->getCategoryRepository()->findAll();
        foreach ($items as $item) {
            $this->pushMessage(sprintf('Delete category: %s', $item->getNom()));
            $this->entityManager->remove($item);
        }
        $this->entityManager->flush();

        $this->assertTrue(true);
    }

    public function testAddCategory()
    {
        for ($i = 1; $i <= 10; $i++) {
            $this->addCategory();
        }

        $this->entityManager->flush();
        $this->entityManager->close();

        $this->assertTrue(true);
    }

    //////////////////////////////////////////////////////////////////

    private function addCategory()
    {
        $nom = $this->faker->jobTitle;

        $v = $this->repoService->getCategoryRepository()->findBy(['nom' => $nom]);
        if (count($v) > 0) {
            $this->pushMessage(sprintf('Category "%s" already added.', $nom));
            return true;
        }

        $category = new Categorie();
        $category->setNom($nom);

        $this->entityManager->persist($category);
        $this->entityManager->flush();

        $this->pushMessage(sprintf('Category "%s" added.', $nom));

        for ($i = 1; $i <= $this->faker->numberBetween(1, 3); $i++) {
            $sub = $this->addSubCategory($category);
        }

        $assoc = $this->repoService->getAssocRepository()->findRandomAssoc();
        $assoc->addSousCategory($sub);

        return true;
    }

    private function addSubCategory(Categorie $category)
    {
        $nom = $this->faker->jobTitle;

        $sub = new SousCategorie();
        $sub->setCategorie($category);
        $sub->setNom($nom);

        $this->entityManager->persist($sub);

        return $sub;
    }
}