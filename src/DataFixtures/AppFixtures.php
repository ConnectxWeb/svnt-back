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

namespace App\DataFixtures;

use App\Entity\Block;
use App\Entity\BlockAttribute;
use App\Entity\Coach;
use App\Entity\Program;
use App\Entity\Seance;
use App\Entity\Theme;
use App\Entity\User;
use App\Entity\UserHasSeance;
use App\Entity\UserLogin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    /**
     * @var Theme[]
     */
    private $themes;
    /**
     * @var ObjectManager
     */
    private $manager;

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        //add themes
        $this->addTheme('Stress');
        $this->addTheme('Sommeil');
        $this->addTheme('Sport');
        $this->addTheme('Emotions');
        $this->addTheme('Alimentation');
        $this->addTheme('Environnement');
        $this->addTheme('Pensée positive');
        $this->addTheme('Pleine conscience');
        $this->addTheme('Féminité');
        $this->addTheme('Fatigue');
        $this->addTheme('Digestif');
        $this->addTheme('Rhumato');
        $this->addTheme('Immunité');

        for ($i = 0; $i < 2; $i++) {
            //User
            $User = new User();
            $User->setEnabled(true);
            $User->setUsername(sprintf('user-%d', rand() * $i));
            $User->setFirstname(sprintf('Firstname %d', $i));
            $User->setLastname(sprintf('Lastname %d', $i));
            $User->setEmail(sprintf('email@host%d.fr', $i));
            $User->setPassword(rand());
            $User->setAge(($i + 1) * 10);
            $manager->persist($User);
            //User login
            for ($m = 0; $m < 8; $m++) {
                $UserLogin = new UserLogin();
                try {
                    $UserLogin->setCreatedAt(new \DateTime());
                } catch (\Exception $e) {
                }
                $UserLogin->setUser($User);
                $manager->persist($UserLogin);
            }

            //coach
            $Coach = new Coach();
            $Coach->setDescription(sprintf('Description %d-%d', $i, rand()));
            $Coach->setImage(sprintf('https://via.placeholder.com/400x400', $i, rand()));
            $manager->persist($Coach);

            for ($j = 0; $j < 2; $j++) {
                //program
                $Program = new Program();
                $Program->setTitle(sprintf('Title %d-%d', $j, rand()));
                $Program->setDescription(sprintf('Description %d-%d', $j, rand()));
                $Program->setImage('https://via.placeholder.com/400x200');
                $Program->setTime('2');
                $Program->setFrequency('Toutes les semaines');
                $Program->setColor('#EA7844');
                $Program->setUrlPdf('http://go/a.pdf');
                $Program->setMaterials('du matos a la toc!');
                $Program->setCoach($Coach);
                $manager->persist($Program);

                //seance
                $Seance = new Seance();
                $Seance->setName(sprintf('Name %d-%d', $j, rand()));
                $Seance->setDescription(sprintf('Description %d-%d', $j, rand()));
                $Seance->setDelay(sprintf('Delay %d-%d', $j, rand()));
                $Seance->setMaterials(sprintf('Materials %d-%d', $j, rand()));
                $Seance->setProgram($Program);
                $block_1 = $this->createBlockFiche();
                $Seance->addBlock($block_1);
                for ($k = 0; $k < 6; $k++) {
                    $block_2 = $this->createBlockProduct();
                    $Seance->addBlock($block_2);
                }
                $manager->persist($Seance);

                //UserHasSeance
                $UserHasSeance = new UserHasSeance();
                sleep(1);//In order to have different DateTIme
                $UserHasSeance->setSeance($Seance);
                $UserHasSeance->setUser($User);
                try {
                    $UserHasSeance->setCreatedAt(new \DateTime());
                } catch (\Exception $e) {
                }
                $manager->persist($UserHasSeance);

                //theme
                $Theme = $this->findRandomTheme();
                $Theme->addSeance($Seance);
                $Theme->addUser($User);
                $Theme->addBlock($block_1);
                $Theme->addBlock($block_2);
                $manager->persist($Theme);

                //seance theme
                $Seance->addTheme($Theme);
                $manager->persist($Seance);
            }
        }
        $manager->flush();
    }

    private function addTheme($name): Theme
    {
        $theme = new Theme();
        $theme->setName($name);
        $this->manager->persist($theme);
        $this->manager->flush();
        $this->themes[] = $theme;
        return $theme;
    }

    private function createBlockFiche()
    {
        $type = Block::TYPE_FICHE;
        $Block = new Block();
        $Block->setType($type);
        $Block->addBlockAttribute($this->createBlockAttribute($type, Block::ATTRIBUTE_NAME));
        $Block->addBlockAttribute($this->createBlockAttribute($type, Block::ATTRIBUTE_LINK));
        return $Block;
    }

    private function createBlockAttribute($type, $attributeName): BlockAttribute
    {
        $AttributeBlock = new BlockAttribute();
        $AttributeBlock->setName($attributeName);
        $AttributeBlock->setValue($this->attributeTypeToValue($attributeName,
            sprintf('Value: %s, %s, %s', $type, $attributeName, rand())));
        return $AttributeBlock;
    }

    private function attributeTypeToValue($attributeName, $defaultText = null)
    {
        $IMG = 'https://via.placeholder.com/100x100';
        if ($attributeName === Block::ATTRIBUTE_IMAGE) {
            return $IMG;
        } elseif ($attributeName === Block::ATTRIBUTE_LINK) {
            return 'https://www.nature.com/articles/d41586-019-01093-x';
        } elseif ($attributeName === Block::ATTRIBUTE_EDITOR) {
            return sprintf('<h3>Message en HTML:</h3>
                %s
                <img src="%s">', $defaultText, $IMG);
        } else {
            return $defaultText;
        }
    }

    private function createBlockProduct()
    {
        $type = Block::TYPE_PRODUCT;
        $Block = new Block();
        $Block->setType($type);
        $Block->addBlockAttribute($this->createBlockAttribute($type, Block::ATTRIBUTE_NAME));
        $Block->addBlockAttribute($this->createBlockAttribute($type, Block::ATTRIBUTE_DESCRIPTION));
        $Block->addBlockAttribute($this->createBlockAttribute($type, Block::ATTRIBUTE_LINK));
        $Block->addBlockAttribute($this->createBlockAttribute($type, Block::ATTRIBUTE_IMAGE));
        return $Block;
    }

    private function findRandomTheme(): Theme
    {
        if (count($this->themes) === 0) {
            return null;
        }
        $idx = rand(0, count($this->themes) - 1);
        return $this->themes[$idx];
    }
}
