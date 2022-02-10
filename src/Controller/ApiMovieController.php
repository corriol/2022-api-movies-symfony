<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiMovieController extends AbstractController
{
    /**
     * @Route("/api/v1/movies", name="api_movies")
     */
    public function index(MovieRepository $movieRepository): Response
    {
        $movies = $movieRepository->findAll();
        $moviesAr = [];
        foreach($movies as $movie) {
            $movieAr["id"] = $movie->getId();
            $movieAr["title"] = $movie->getTitle();
            $movieAr["overview"] = $movie->getOverview();
            $moviesAr[] = $movieAr;
        }

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'data' => $moviesAr
        ]);
    }
}
