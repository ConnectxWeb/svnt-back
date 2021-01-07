<?php

namespace App\Tests;


use App\Entity\User;

class UserTest extends UnitBase
{
    public function testAddUsers()
    {
        $this->addUser("admin", "admin", "info@connectx.fr", ['ROLE_ADMIN']);

        $this->entityManager->flush();
        $this->entityManager->close();

        $this->assertTrue(true);
    }

    //////////////////////////////////////////////////////////////////

    private function addUser(string $userName, string $pwd, string $email, array $roles)
    {
        $v = $this->repoService->getUserRepository()->findBy(['username' => $userName]);
        if (count($v) > 0) {
            $this->pushMessage(sprintf('User "%s" already added.', $userName));
            return true;
        }

        $user = new User();
        $user->setUsername($userName);
        $user->setPlainPassword($pwd);
        $user->setEnabled(true);
        $user->setEmail($email);
        $user->setRoles($roles);
        $this->entityManager->persist($user);

        $this->pushMessage(sprintf('User "%s" added.', $userName));

        return true;
    }
}