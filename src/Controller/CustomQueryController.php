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

    public function __construct(RepoService $repoService)
    {
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
        // http://svnt.loc/api/findAssocs?villeId=2&chien=1&handicap=1
        $villeId = $r->get('villeId');
        $chien = $r->get('chien');
        $handicap = $r->get('handicap');
        $assocs = $this->repoService->getAssocRepository()->findCustom($villeId, $chien, $handicap);

        return $assocs;
    }

}