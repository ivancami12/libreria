<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListaLibrosController extends AbstractController
{
    #[Route('libros', name: 'app_lista_libros')]
    public function index(): Response
    {
        return $this->render('lista_libros/index.html.twig', [
            'controller_name' => 'ListaLibrosController',
        ]);
    }
        public function lista(): Respose
        {
            $entityManager = $this->getDoctrine()->getManager();
            $libros = $entityManager->getRepositoty(libros::class)->FindAll();

            return $this->render('lista_libros/index.html.twig', [
                'controller_name' => 'ListaLibrosController',
            ]);
        }

}
