<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api/v1")
 */
class ApiMovieController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(path="/movies", name="api_movies")
     * @Rest\View(serializerGroups={"movie"}, serializerEnableMaxDepthChecks=true)
     */
    public function list(MovieRepository $movieRepository)
    {
        return $movieRepository->findAll();
    }

    /**
     * @Rest\Post(path="/movies", name="api_movies_create")
     * @Rest\View(serializerGroups={"movie"}, serializerEnableMaxDepthChecks=true)
     */
    public function new(Request $request, EntityManagerInterface $entityManager)
    {
        // configurem el context vista dinamicament
        // $view = View::create();
        // $context = new Context();
        // $context->setVersion('1.0');
        // $context->addGroup('movie');
        //$view->setContext($context);

        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);

        // $data = json_decode($request->getContent(), true);
        // $form->submit($data);
        // podem usar el mètode handleRequest com ho fem normalment pels canvis
        // introduïts en MovieFormType
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($movie);
            $entityManager->flush();
            //$view->setData($movie);
            //$view->setStatusCode(Response::HTTP_CREATED);
            //$view = $this->view($movie, Response::HTTP_CREATED);
            //dump($view->getContext());
            return($this->view($movie, Response::HTTP_CREATED));
        }
        return $this->view($form, Response::HTTP_BAD_REQUEST);
    }
}
