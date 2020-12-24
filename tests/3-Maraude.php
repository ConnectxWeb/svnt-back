<?php

namespace App\Tests;


use App\Entity\Assoc;
use App\Entity\Maraude;
use App\Entity\Ouverture;

class MaraudeTest extends UnitBase
{
    const DELETE_ALL = true;

    public function testDelete()
    {
        if (!self::DELETE_ALL) {
            $this->assertTrue(true);

            return;
        }

        $items = $this->repoService->getMaraudeRepository()->findAll();
        foreach ($items as $item) {
            $this->pushMessage(sprintf('Delete maraude: %s', $item->getNom()));
            $this->entityManager->remove($item);
        }
        $this->entityManager->flush();
        $this->assertTrue(true);
    }

    public function testAddMaraudes()
    {
        for ($i = 1; $i <= 10; $i++) {
            $this->addMaraude();
        }

        $this->entityManager->flush();
        $this->entityManager->close();

        $this->assertTrue(true);
    }

    //////////////////////////////////////////////////////////////////

    private function addMaraude()
    {
        $nom = $this->faker->company;

        $v = $this->repoService->getAssocRepository()->findBy(['nom' => $nom]);
        if (count($v) > 0) {
            $this->pushMessage(sprintf('Maraude "%s" already added.', $nom));
            return true;
        }

        $maraude = new Maraude();
        $maraude->setAssoc($this->repoService->getAssocRepository()->findRandomAssoc());

        $maraude->setNom($nom);
        $maraude->setDescription($this->faker->text);
        $maraude->setTelephone($this->faker->phoneNumber);
        $maraude->setAdresse($this->faker->address);
        $maraude->setLongitude($this->faker->longitude);
        $maraude->setLatitude($this->faker->latitude);

        $durationDays = $this->faker->numberBetween(1, 30 * 12);
        $startDay = $this->faker->numberBetween(1, 30 * 2);
        $maraude->setDateDebut($this->faker->dateTimeBetween('0 days', sprintf('+%d days', $startDay)));
        $maraude->setDateFin($this->faker->dateTimeBetween(sprintf('%d days', $startDay),
            sprintf('+%d days', $startDay + $durationDays)));

        for ($i = 1; $i <= $this->faker->numberBetween(1, 10); $i++) {
            $ouverture = $this->addOuverture($maraude);
            $maraude->addOuverture($ouverture);
        }

        $this->entityManager->persist($maraude);
        $this->pushMessage(sprintf('Maraude "%s" added.', $nom));

        return true;
    }
}