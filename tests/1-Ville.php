<?php

namespace App\Tests;


use App\Entity\Ville;

class VilleTest extends UnitBase
{
    public function testAddVille()
    {
        $this->addVille("Toulouse");
        $this->addVille("Montpellier");

        $this->entityManager->flush();
        $this->entityManager->close();

        $this->assertTrue(true);
    }

    //////////////////////////////////////////////////////////////////

    private function addVille(string $nom)
    {
        $v = $this->repoService->getVilleRepository()->findBy(['nom' => $nom]);
        if (count($v) > 0) {
            $this->pushMessage(sprintf('Ville "%s" already added.', $nom));
            return true;
        }

        $ville = new Ville();
        $ville->setNom($nom);
        $this->entityManager->persist($ville);
        $this->pushMessage(sprintf('Ville "%s" added.', $nom));

        return true;
    }
}