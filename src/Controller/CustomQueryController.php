<?php

namespace App\Controller;


use App\Service\RepoService;
use App\Entity\Assoc;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CustomQueryController extends AbstractController
{
    /**
     * @var RepoService
     */
    private $repoService;

    public function __construct(
        RepoService $repoService
    ) {
        $this->repoService = $repoService;
    }

    /**
     * @Route("/api/findAssocs",
     *     name="find_assocs",
     *     defaults={
     *          "_api_resource_class"=Assoc::class,
     *          "_api_collection_operation_name"="findAssocs"
     * })
     * @param Request $r
     * @return array
     */
    public function findAssocs(Request $r)
    {
        $assocs = $this->repoService->getAssocRepository()->findBy([]);
//        $limit = ($request->get('limit') !== null ? $request->get('limit') : null);
//        $userSeances = $this->userHasSeanceRepository->findBy(array(), null, $limit);
//        if (count($userSeances) === 0) {
//            return $userSeances;
//        }
//        //group by seance
//        $seances = null;
//        foreach ($userSeances as $userSeance) {
//            $seances[$userSeance->getSeance()->getId()][] = $userSeance->getSeance();
//        }
//        //create associative array with userCount
//        $userSeances = array();
//        foreach ($seances as $seance) {
//            $userSeances[] =
//                [
//                    'seance' => current($seance),
//                    'userCount' => count($seance)
//                ];
//        }
//        //sort by userCount
//        usort($userSeances, function ($item1, $item2) {
//            return $item2['userCount'] <=> $item1['userCount'];
//        });

        return $assocs;
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
//        $limit = ($request->get('limit') !== null ? $request->get('limit') : null);
//        $userSeances = $this->userHasSeanceRepository->findBy(array(), null, $limit);
//        if (count($userSeances) === 0) {
//            return $userSeances;
//        }
//        //group by program
//        $programs = null;
//        foreach ($userSeances as $userSeance) {
//            $programs[$userSeance->getSeance()->getProgram()->getId()][] = $userSeance->getSeance()->getProgram();
//        }
//        //create associative array with userCount
        $userPrograms = array();
//        foreach ($programs as $program) {
//            $userPrograms[] =
//                [
//                    'program' => current($program),
//                    'userCount' => count($program)
//                ];
//        }
//        //sort by userCount
//        usort($userPrograms, function ($item1, $item2) {
//            return $item2['userCount'] <=> $item1['userCount'];
//        });

        return $userPrograms;
    }
}