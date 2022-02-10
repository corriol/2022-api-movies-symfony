<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiMovieController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(path="/api/v1/movies", name="api_movies")
     * @Rest\View(serializerGroups={"movie"}, serializerEnableMaxDepthChecks=true)
     */
    public function index(MovieRepository $movieRepository) {
        return $movieRepository->findAll();
    }

}
