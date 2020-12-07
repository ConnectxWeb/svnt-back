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

namespace App\Controller;

use App\Entity\Seance;
use App\Repository\SeanceRepository;
use App\Repository\UserHasSeanceRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CustomQueryController extends AbstractController
{
    private $userRepository;
    private $userHasSeanceRepository;
    private $seanceRepository;

    public function __construct(
        UserRepository $userRepository,
        UserHasSeanceRepository $userHasSeanceRepository,
        SeanceRepository $seanceRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userHasSeanceRepository = $userHasSeanceRepository;
        $this->seanceRepository = $seanceRepository;
    }

    /**
     * @Route("/query/bestSeances",
     *     name="find_best_seances",
     *     defaults={
     *          "_api_resource_class"=Seance::class,
     *          "_api_collection_operation_name"="findBestSeances"
     * })
     * @param Request $request
     * @return array
     */
    public function findBestSeances(Request $request)
    {
        $limit = ($request->get('limit') !== null ? $request->get('limit') : null);
        $userSeances = $this->userHasSeanceRepository->findBy(array(), null, $limit);
        if (count($userSeances) === 0) {
            return $userSeances;
        }
        //group by seance
        $seances = null;
        foreach ($userSeances as $userSeance) {
            $seances[$userSeance->getSeance()->getId()][] = $userSeance->getSeance();
        }
        //create associative array with userCount
        $userSeances = array();
        foreach ($seances as $seance) {
            $userSeances[] =
                [
                    'seance' => current($seance),
                    'userCount' => count($seance)
                ];
        }
        //sort by userCount
        usort($userSeances, function ($item1, $item2) {
            return $item2['userCount'] <=> $item1['userCount'];
        });
        return $userSeances;
    }

    /**
     * @Route("/query/bestPrograms",
     *     name="find_best_programs",
     *     defaults={
     *          "_api_resource_class"=Seance::class,
     *          "_api_collection_operation_name"="findBestPrograms"
     * })
     * @param Request $request
     * @return array
     */
    public function findBestPrograms(Request $request)
    {
        $limit = ($request->get('limit') !== null ? $request->get('limit') : null);
        $userSeances = $this->userHasSeanceRepository->findBy(array(), null, $limit);
        if (count($userSeances) === 0) {
            return $userSeances;
        }
        //group by program
        $programs = null;
        foreach ($userSeances as $userSeance) {
            $programs[$userSeance->getSeance()->getProgram()->getId()][] = $userSeance->getSeance()->getProgram();
        }
        //create associative array with userCount
        $userPrograms = array();
        foreach ($programs as $program) {
            $userPrograms[] =
                [
                    'program' => current($program),
                    'userCount' => count($program)
                ];
        }
        //sort by userCount
        usort($userPrograms, function ($item1, $item2) {
            return $item2['userCount'] <=> $item1['userCount'];
        });
        return $userPrograms;
    }
}