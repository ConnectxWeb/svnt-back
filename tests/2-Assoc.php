<?php

namespace App\Tests;


use App\Entity\Assoc;
use App\Entity\Ouverture;

class AssocTest extends UnitBase
{
    const DELETE_ALL = true;

    public function testDelete()
    {
        if (!self::DELETE_ALL) {
            $this->assertTrue(true);

            return;
        }

        $assocs = $this->repoService->getAssocRepository()->findAll();
        foreach ($assocs as $assoc) {
            $this->pushMessage(sprintf('Delete assoc: %s', $assoc->getNom()));
            $this->entityManager->remove($assoc);
        }
        $this->entityManager->flush();
        $this->assertTrue(true);
    }

    public function testAddAssocs()
    {
        for ($i = 1; $i <= 10; $i++) {
            $this->addAssoc();
        }

        $this->entityManager->flush();
        $this->entityManager->close();

        $this->assertTrue(true);
    }

    //////////////////////////////////////////////////////////////////

    private function addAssoc()
    {
        $nom = $this->faker->company;

        $v = $this->repoService->getAssocRepository()->findBy(['nom' => $nom]);
        if (count($v) > 0) {
            $this->pushMessage(sprintf('Assoc "%s" already added.', $nom));
            return true;
        }

        $assoc = new Assoc();
        $assoc->setVille($this->repoService->getVilleRepository()->findRandomVille());

        $assoc->setNom($nom);
        $assoc->setDescription($this->faker->text);
        $assoc->setTelephone($this->faker->phoneNumber);
        $assoc->setAdresse($this->faker->address);
        $assoc->setLongitude($this->faker->longitude);
        $assoc->setLatitude($this->faker->latitude);

        $assoc->setHomme($this->faker->boolean);
        $assoc->setFemme($this->faker->boolean);
        $assoc->setChien($this->faker->boolean);
        $assoc->setHandicap($this->faker->boolean);

        for ($i = 1; $i <= $this->faker->numberBetween(1, 10); $i++) {
            $ouverture = $this->addOuverture();
            $assoc->addOuverture($ouverture);
        }

        $this->entityManager->persist($assoc);
        $this->pushMessage(sprintf('Assoc "%s" added.', $nom));

        return true;
    }
}