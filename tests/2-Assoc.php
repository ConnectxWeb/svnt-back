<?php
/**
 * This code is open source and licensed under the MIT License
 * Author: Benjamin Leveque <info@connectx.fr>
 * Copyright (c) - connectX
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

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
        for ($i = 1; $i <= 5; $i++) {
            $this->addAssoc($this->faker->company, $this->faker->text, $this->faker->phoneNumber, $this->faker->address,
                $this->faker->longitude, $this->faker->latitude, $this->faker->boolean, $this->faker->boolean,
                $this->faker->boolean, $this->faker->boolean);
        }

        $this->entityManager->flush();
        $this->entityManager->close();

        $this->assertTrue(true);
    }

    //////////////////////////////////////////////////////////////////

    private function addAssoc(
        string $nom,
        string $description,
        string $phoneNumber,
        string $address,
        float $longitude,
        float $latitude,
        bool $homme,
        bool $femme,
        bool $chien,
        bool $handicap
    ) {
        $v = $this->repoService->getAssocRepository()->findBy(['nom' => $nom]);
        if (count($v) > 0) {
            $this->pushMessage(sprintf('Assoc "%s" already added.', $nom));
            return true;
        }

        $assoc = new Assoc();
        $assoc->setVille($this->repoService->getVilleRepository()->findRandomVille());
        $assoc->setNom($nom);
        $assoc->setDescription($description);
        $assoc->setTelephone($phoneNumber);
        $assoc->setAdresse($address);
        $assoc->setLongitude($longitude);
        $assoc->setLatitude($latitude);
        $assoc->setHomme($homme);
        $assoc->setFemme($femme);
        $assoc->setChien($chien);
        $assoc->setHandicap($handicap);

        for ($i = 1; $i <= $this->faker->numberBetween(1, 10); $i++) {
            $this->addOuverture($assoc);
        }

        $this->entityManager->persist($assoc);
        $this->pushMessage(sprintf('Assoc "%s" added.', $nom));

        return true;
    }

    private function addOuverture(Assoc $assoc)
    {
        $ouverture = new Ouverture();
        $ouverture->setJourIndex($this->faker->numberBetween(1, 7));

        $debut = new \DateTime();
        $debut->setTime($this->faker->numberBetween(0, 24), $this->faker->numberBetween(0, 60));
        $ouverture->setHeureDebut($debut);

        $fin = new \DateTime();
        $fin->setTime($this->faker->numberBetween(0, 24), $this->faker->numberBetween(0, 60));
        $ouverture->setHeureFin($fin);

        $this->entityManager->persist($ouverture);
        $assoc->addOuverture($ouverture);
    }
}