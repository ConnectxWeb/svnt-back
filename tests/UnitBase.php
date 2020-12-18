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

use App\Service\RepoService;
use Doctrine\Common\Persistence\ObjectManager;
use Faker; //composer require fzaninotto/faker
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Finder\Finder;


class UnitBase extends WebTestCase
{
    const DELETE_ALL = false;

    /**
     * @var ObjectManager|object
     */
    protected $entityManager;
    /**
     * @var Faker\Generator
     */
    protected $faker;
    /**
     * @var KernelBrowser
     */
    protected $client;
    /**
     * @var \App\Service\RepoService
     */
    protected $repoService;

    protected function setUp()
    {
        $this->client = static::createClient();

        $this->entityManager = self::bootKernel()->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->faker = Faker\Factory::create('fr_FR');

        $this->repoService = self::$container->get(RepoService::class); //dont forget to declare it public in service.yaml
    }

    protected function tearDown()
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null; // avoid memory leaks
    }


    protected function pushMessage(string $msg)
    {
        fwrite(STDERR, sprintf("%s\n", $msg));
    }

    /////////////////////////////////////


}

