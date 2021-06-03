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

namespace App\Service;


use App\Repository\AssocRepository;
use App\Repository\CategorieRepository;
use App\Repository\MaraudeRepository;
use App\Repository\OuvertureRepository;
use App\Repository\SousCategorieRepository;
use App\Repository\UserRepository;
use App\Repository\VilleRepository;

class RepoService
{
    /**
     * @var VilleRepository
     */
    private $villeRepository;
    /**
     * @var AssocRepository
     */
    private $assocRepository;
    /**
     * @var MaraudeRepository
     */
    private $maraudeRepository;
    /**
     * @var OuvertureRepository
     */
    private $ouvertureRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var CategorieRepository
     */
    private $categoryRepository;
    /**
     * @var SousCategorieRepository
     */
    private $sousCategorieRepository;

    public function __construct(
        AssocRepository $assocRepository,
        MaraudeRepository $maraudeRepository,
        OuvertureRepository $ouvertureRepository,
        VilleRepository $villeRepository,
        UserRepository $userRepository,
        CategorieRepository $categoryRepository,
        SousCategorieRepository $sousCategorieRepository
    ) {
        $this->assocRepository = $assocRepository;
        $this->maraudeRepository = $maraudeRepository;
        $this->ouvertureRepository = $ouvertureRepository;
        $this->villeRepository = $villeRepository;
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
        $this->sousCategorieRepository = $sousCategorieRepository;
    }

    /**
     * @return VilleRepository
     */
    public function getVilleRepository(): VilleRepository
    {
        return $this->villeRepository;
    }

    /**
     * @return AssocRepository
     */
    public function getAssocRepository(): AssocRepository
    {
        return $this->assocRepository;
    }

    /**
     * @return MaraudeRepository
     */
    public function getMaraudeRepository(): MaraudeRepository
    {
        return $this->maraudeRepository;
    }

    /**
     * @return OuvertureRepository
     */
    public function getOuvertureRepository(): OuvertureRepository
    {
        return $this->ouvertureRepository;
    }

    /**
     * @return UserRepository
     */
    public function getUserRepository(): UserRepository
    {
        return $this->userRepository;
    }

    /**
     * @return CategorieRepository
     */
    public function getCategoryRepository(): CategorieRepository
    {
        return $this->categoryRepository;
    }

    /**
     * @return SousCategorieRepository
     */
    public function getSousCategorieRepository(): SousCategorieRepository
    {
        return $this->sousCategorieRepository;
    }
}