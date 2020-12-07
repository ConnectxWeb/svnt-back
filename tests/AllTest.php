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

use App\Entity\Block;
use App\Services\AngularGenerator;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\ToolsException;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Doctrine\ORM\Tools\SchemaTool;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\BrowserKit\Client;


class AllTest extends WebTestCase
{
    const DELETE_TESTS = false;
    const DROP_DB = true;
    const PROCESS_FIXTURE = true;

    /**
     * @var Client
     */
    private $client;
    /**
     * @var EntityManager
     */
    private $em;
    /**
     * @var Swift_Mailer
     */
    private $mailer;

    private $userEmail = 'aaa@aaa.aaa';
    private $userPwd = '123456';
    private $token = null;

    public function setUp()
    {
        self::bootKernel();
        $this->mailer = self::$container->get('swiftmailer.mailer.default');

        $this->em = $this->getContainer()->get('doctrine')->getManager();

        $this->client = static::createClient();
        $headers['HTTP_ACCEPT'] = 'application/ld+json';
        $headers['CONTENT_TYPE'] = 'application/ld+json';
        $this->client->setServerParameters($headers);
    }

//    public function tearDown()
//    {
//        $this->mailer = null;
//        parent::tearDown();
//    }

    public function testMailer()
    {
        $message = (new Swift_Message())
            ->setSubject('The subject')
            ->setFrom(['noreply@bbb.bbb' => 'John Doe'])
            ->setTo(['aaa@aaa.aaa' => 'A name'])
            ->setBody('Here is the message itself')
            ->addPart('<q>Here is the message itself</q> <b>in bold!</b>', 'text/html');
        try {
            $result = $this->mailer->send($message);
            $this->assertTrue($result > 0);
        } catch (\Exception $e) {
            $this->assertTrue(false);
        }
    }

    public function testGenerateTsInterface()
    {
        $generator = new AngularGenerator($this->em);
        $generator->generateTsInterface();
        $this->assertTrue($generator->generateTsInterface());

        //create endpoints --------------------------------------------------------------------------------
        $client = static::createClient();
        $headers['HTTP_ACCEPT'] = 'application/json';
        $headers['CONTENT_TYPE'] = 'application/json';
        $client->setServerParameters($headers);
        $client->request('GET', '/docs.json');
        $endpoints = array();
        if ($client->getResponse()->getStatusCode() === 200) {
            $json = json_decode($client->getResponse()->getContent(), true);
            foreach ($json['paths'] as $path => $value) {
                if (preg_match('/^\/[a-zA-Z0-9_-]*$/', $path)) {
                    $endpoints[] = $path;
                }
            }
        }
        $endpoints[] = '/login_check';
        $this->assertTrue($generator->generateEndpoints($endpoints));
    }

    public function testDropDB()
    {
        if (self::DROP_DB) {
            //Delete database
            $schemaTool = new SchemaTool($this->em);
            $schemaTool->dropDatabase();
        }
        $this->assertTrue(true);
    }

    public function testCleanDbLoadFixture()
    {
        if (self::DROP_DB) {
            $metadatas = $this->em->getMetadataFactory()->getAllMetadata();
            $schemaTool = new SchemaTool($this->em);
            $schemaTool->dropDatabase();
            if (!empty($metadatas)) {
                try {
                    $schemaTool->createSchema($metadatas);
                } catch (ToolsException $e) {
                    $this->assertTrue(false);
                }
            }
        }

        if (self::PROCESS_FIXTURE) {
            $this->postFixtureSetup();
            $fixtures = array(
                'App\DataFixtures\AppFixtures',
            );
            $this->loadFixtures($fixtures);
        }

        $this->assertTrue(true);
    }

    public function testCreateLoginUser()
    {
        $this->client->request('GET', sprintf('/users/?email=%s', $this->userEmail));
        if ($this->client->getResponse()->getStatusCode() === 200) {
            $json = json_decode($this->client->getResponse()->getContent(), true);
            if ($json['hydra:totalItems'] > 0) {
                $this->assertTrue(true);
                return;
            }
        }

        $user = $this->createUser($this->userEmail, $this->userPwd, array('ROLE_ADMIN'));
        $this->client->request('POST', '/users', array(), array(), array(), json_encode($user));
        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
    }

    private function createUser($email = null, $pwd = null, array $roles = null): array
    {
        $rand = 'char' . strval(rand());
        $email = (is_null($email) ? sprintf('%s@%s.%s', $rand, $rand, $rand) : $email);
        $user = array
        (
            "username" => $email,
            "email" => (is_null($email) ? sprintf('%s@%s.%s', $rand, $rand, $rand) : $email),
            "enabled" => true,
            "plainPassword" => (is_null($pwd) ? $rand : $pwd),
            "lastname" => $rand,
            "firstname" => $rand,
            "age" => 43,
            "gender" => "M",
            "region" => 31400,
            "newsletter" => true,
            "note" => $rand,
            "roles" => $roles
        );
        return $user;
    }

    public function testLogin()
    {
        $this->assertTrue($this->login());
    }

    private function login(): bool
    {
        if (isset($this->token)) {
            return true;
        }
        $credentials['username'] = $this->userEmail;
        $credentials['password'] = $this->userPwd;
        $this->client->request('POST', '/login_check', array(), array(), array(), json_encode($credentials));
        if ($this->client->getResponse()->getStatusCode() !== 200) {
            echo $this->client->getResponse();
            return false;
        }
        $data = $this->client->getResponse()->getContent();
        if (!(strlen($data) > 0)) {
            return false;
        }
        $arToken = json_decode($data);
        if (is_null($arToken)) {
            return false;
        }
        $this->token = $arToken->token;
        if (!(strlen($this->token) > 0)) {
            return false;
        }
        $this->client->setServerParameter('HTTP_AUTHORIZATION', sprintf('Bearer %s', $this->token));
        return true;
    }

    public function testCreateRandomUser()
    {
        $user = $this->createUser(null, null, array('ROLE_USER'));
        $this->client->request('POST', '/users', array(), array(), array(), json_encode($user));
        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
    }

    public function testCreateSeance()
    {
        $this->assertTrue($this->login());

        $seance = $this->createSeance();
        $this->client->request('POST', '/seances', array(), array(), array(), json_encode($seance));
        $this->assertTrue(
            $this->client->getResponse()->headers->contains(
                'Content-Type',
                'application/ld+json; charset=utf-8'
            )
        );
        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
        $new_seance = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertInternalType('array', $new_seance);
        //TODO : Other test on seance
    }

    private function createSeance(): array
    {
        $seance = array
        (
            "name" => "aguillerm",
            "materials" => "list of materials",
            "delay" => "10 J",
            "description" => "A liitle description",
            "program" => "/programs/1"
        );
        $seance["theme"] = array("/themes/1", "/themes/2");
        $seance["user"] = array("/users/1");
        return $seance;
    }

    public function testGetAllSeances()
    {
        $this->assertTrue($this->login());

        $this->client->request('GET', '/seances', array(), array(), array());
        $this->assertTrue(
            $this->client->getResponse()->headers->contains(
                'Content-Type',
                'application/ld+json; charset=utf-8'
            )
        );
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testGetLastSeance()
    {
        $this->assertTrue($this->login());

        $lastSeance = $this->readLastSeance();
        $this->assertTrue($lastSeance !== false);

        $this->client->request('GET', sprintf("/seances/%d", $lastSeance['id']), array(), array(), array());
        $this->assertTrue(
            $this->client->getResponse()->headers->contains(
                'Content-Type',
                'application/ld+json; charset=utf-8'
            )
        );
        $new_seance = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertInternalType('array', $new_seance);
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    private function readLastSeance()
    {
        $this->client->request('GET', sprintf('/seances?order[id]=%s', 'desc'));
        if ($this->client->getResponse()->getStatusCode() !== 200) {
            return false;
        }
        $json = json_decode($this->client->getResponse()->getContent(), true);
        if ($json['hydra:totalItems'] == 0) {
            return false;
        }
        return current($json['hydra:member']);
    }

    public function testDeleteLastSeance()
    {
        if (!self::DELETE_TESTS) {
            $this->assertTrue(true);
            return;
        }
        $this->assertTrue($this->login());

        $lastSceance = $this->readLastSeance();
        $this->assertTrue($lastSceance !== false);

        $this->client->request('DELETE', sprintf("/seances/%d", $lastSceance['id']), array(), array(), array());
        $this->assertEquals(204, $this->client->getResponse()->getStatusCode());
    }

    public function testDeleteLastUser()
    {
        if (!self::DELETE_TESTS) {
            $this->assertTrue(true);
            return;
        }
        $this->assertTrue($this->login());

        $lastUser = $this->readLastUser();
        $this->assertTrue($lastUser !== false);

        $this->client->request('DELETE', sprintf("/users/%d", $lastUser['id']), array(), array(), array());
        $this->assertEquals(204, $this->client->getResponse()->getStatusCode());
    }

    private function readLastUser()
    {
        $this->client->request('GET', '/users?order[id]=desc');
        if ($this->client->getResponse()->getStatusCode() !== 200) {
            return false;
        }
        $json = json_decode($this->client->getResponse()->getContent(), true);
        if ($json['hydra:totalItems'] == 0) {
            return false;
        }
        return current($json['hydra:member']);
    }

    public function testChangeUser()
    {
        //Get login
        $new_user = $this->getCurrentUser();
        //Change Info of the current user
        $rand = 'char' . strval(rand());
        $new_user['username'] = sprintf('%s@%s.%s', $rand, $rand, $rand);
        $id = $new_user['id'];
        $this->client->request("PUT", "/users/$id", array(), array(), array(), json_encode($new_user));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $new_user = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertInternalType('array', $new_user);
        $this->userEmail = $new_user['username'];
        $this->token = null;

        //Try login again
        $this->assertTrue($this->login());

    }

    private function getCurrentUser(): array
    {
        $this->assertTrue($this->login());
        $this->client->request('GET', sprintf('/users/?email=%s', $this->userEmail));
        $json = json_decode($this->client->getResponse()->getContent(), true);
        $new_user = current($json['hydra:member']);
        return $new_user;
    }

    public function testGetAvancementOfUser()
    {
        //Get all infos of current user
        $new_user = $this->getCurrentUser();
        $id = $new_user['id'];
        $this->client->request("GET", "/users/$id");
        $json = json_decode($this->client->getResponse()->getContent(), true);
        $seances = $json['seance'];
        //If user have seance
        if (count($seances) > 0) {
            $program_iri = $seances[0]['seance']['program'];
            $progression = current($this->getProgression($program_iri, $seances));
            $this->assertEquals($seances[0]['seance']['@id'], $progression);
        }

    }

    /**
     * @param $programme_iri : IRI of the program
     * @param $seancesOfUser :Array of all seance of thee user
     * @return array
     */
    private function getProgression($programme_iri, $seancesOfUser): array
    {
        $seance_with_order = array();
        foreach ($seancesOfUser as $seance) {
            if ($programme_iri == $seance['seance']['program']) {
                $seance_with_order[$seance['seance']['@id']] = $seance['seance']['orderPriority'];
            }
        }
        $progression = max($seance_with_order);
        $progression_array = array_keys(array_filter($seance_with_order, function ($order) use ($progression) {
            return $order == $progression;
        }));
        return $progression_array;
    }

    public function testCreateBlock()
    {
        $this->assertTrue($this->login());

        $seance = $this->createSeance();
        $block = $this->createProduct();
        $seance['block'] = array();
        array_push($seance['block'], $block);
        $this->client->request('POST', '/seances', array(), array(), array(), json_encode($seance));
        $this->assertTrue(
            $this->client->getResponse()->headers->contains(
                'Content-Type',
                'application/ld+json; charset=utf-8'
            )
        );
        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
        $new_seance = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertInternalType('array', $new_seance);
    }

    private function createProduct()
    {
        $block = array(
            'type' => Block::TYPE_PRODUCT,
            'theme' => array('/themes/1'),
            'blockAttribute' => array()
        );
        $block["blockAttribute"] = $this->createProductAttribute();

        return $block;
    }

    private function createProductAttribute()
    {
        $blockAttribute = array();
        array_push($blockAttribute, array('name' => 'title', 'value' => 'Mon produit 1'));
        array_push($blockAttribute, array('name' => 'description', 'value' => 'Ma description du produit'));
        array_push($blockAttribute, array('name' => 'image', 'value' => 'http://monimagetst.fr'));
        array_push($blockAttribute, array('name' => 'url', 'value' => 'http://monUrlExterne.fr'));

        return $blockAttribute;
    }

    public function testUpdateLastSeance()
    {
        $this->assertTrue($this->login());

        $seance = $this->createSeance();
        $seance['description'] = "A description test update";

        $lastSceance = $this->readLastSeance();
        $this->assertTrue($lastSceance !== false);

        $this->client->request('PUT', sprintf("/seances/%d", $lastSceance['id']), array(), array(), array(),
            json_encode($seance));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $new_seance = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertInternalType('array', $new_seance);
        //TODO : Other test on seance
    }

    public function testAddSeanceToUser()
    {
        //Get User
        $currentUser = $this->getCurrentUser();
        //Get a seance
        $lastSceance = $this->readLastSeance();
        $this->assertTrue($lastSceance !== false);
        $user_has_seance = array(
            "seance" => sprintf("/seances/%d", $lastSceance['id']),
            "user" => sprintf("/users/%d", $currentUser['id'])
        );
        //Add seance to a user
        $this->client->request("POST", "user_has_seances", array(), array(), array(), json_encode($user_has_seance));
        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
    }

    public function testDeletePrograms()
    {
        if (!self::DELETE_TESTS) {
            $this->assertTrue(true);
            return;
        }
        //Get logged user
        $this->assertTrue($this->login());
        //Get all programm
        $this->client->request("GET", "/programs");
        if ($this->client->getResponse()->getStatusCode() === 200) {
            $json = json_decode($this->client->getResponse()->getContent(), true);
            if ($json['hydra:totalItems'] > 0) {
                $programs = $json['hydra:member'];
                foreach ($programs as $program) {
                    //Store the infos of the old seances
                    $id = $program['id'];
                    $this->client->request("GET", "/seances?program=$id");
                    $old_json = json_decode($this->client->getResponse()->getContent(), true);
                    $old_seances = $old_json['hydra:member'];
                    //Delete the current programm
                    $this->client->request("DELETE", "/programs/$id");
                    $this->assertEquals("204", $this->client->getResponse()->getStatusCode());
                    //Verify there is no seance with current programm
                    $this->client->request("GET", "/seances?program=$id");
                    $this->assertEquals("200", $this->client->getResponse()->getStatusCode());
                    $new_json = json_decode($this->client->getResponse()->getContent(), true);
                    $this->assertEquals(0, $new_json['hydra:totalItems']);
                    //Verify there is no association
                    foreach ($old_seances as $old_seance) {
                        $id_seance = $old_seance['id'];
                        $this->client->request("GET", "/user_has_seances?seance.id=$id_seance");
                        $result_json = json_decode($this->client->getResponse()->getContent(), true);
                        $this->assertEquals(0, $result_json['hydra:totalItems']);
                    }
                }
            }
        }

    }

    public function testDeleteUsers()
    {
        if (!self::DELETE_TESTS) {
            $this->assertTrue(true);
            return;
        }
        $this->assertTrue($this->login());
        $this->client->request("GET", "/users");
        if ($this->client->getResponse()->getStatusCode() === 200) {
            $json = json_decode($this->client->getResponse()->getContent(), true);
            if ($json['hydra:totalItems'] > 0) {
                $users = $json['hydra:member'];
                foreach ($users as $user) {
                    $id_user = $user['id'];
                    if ($user['email'] != $this->userEmail) {
                        $this->client->request("DELETE", "/users/$id_user");
                        $this->assertEquals("204", $this->client->getResponse()->getStatusCode());
                        $this->client->request("GET", "/user_has_seances?user.id=$id_user");
                        $result_json = json_decode($this->client->getResponse()->getContent(), true);
                        $this->assertEquals(0, $result_json['hydra:totalItems']);
                    }
                }
            }
        }
    }

    public function testDeleteThemes()
    {
        if (!self::DELETE_TESTS) {
            $this->assertTrue(true);
            return;
        }
        $this->assertTrue($this->login());
        $this->client->request("GET", "/themes");
        if ($this->client->getResponse()->getStatusCode() === 200) {
            $json = json_decode($this->client->getResponse()->getContent(), true);
            if ($json['hydra:totalItems'] > 0) {
                $themes = $json['hydra:member'];
                foreach ($themes as $theme) {
                    $id_theme = $theme['id'];
                    $this->client->request("DELETE", "/themes/$id_theme");
                    $this->assertEquals("204", $this->client->getResponse()->getStatusCode());
                    $this->client->request("GET", "/products?theme=$id_theme");
                    $result_json = json_decode($this->client->getResponse()->getContent(), true);
                    $this->assertEquals(0, $result_json['hydra:totalItems']);
                    $this->client->request("GET", "/therapies?theme=$id_theme");
                    $result_json = json_decode($this->client->getResponse()->getContent(), true);
                    $this->assertEquals(0, $result_json['hydra:totalItems']);
                }
            }
        }
    }

    public function testDeleteCoaches()
    {
        if (!self::DELETE_TESTS) {
            $this->assertTrue(true);
            return;
        }
        $this->assertTrue($this->login());
        $return = $this->deleteSimpleTable("coaches");
        $this->assertTrue($return);
    }

    private function deleteSimpleTable($table)
    {
        if (!self::DELETE_TESTS) {
            return true;
        }
        $this->client->request("GET", "/$table");
        if ($this->client->getResponse()->getStatusCode() !== 200) {
            return false;
        }
        $json = json_decode($this->client->getResponse()->getContent(), true);
        if ($json['hydra:totalItems'] == 0) {
            return true;
        }
        $datas = $json['hydra:member'];
        foreach ($datas as $data) {
            $id_data = $data['id'];
            $this->client->request("DELETE", "/$table/$id_data");
            if ($this->client->getResponse()->getStatusCode() != 204) {
                return false;
            }
        }
        return true;
    }

}