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