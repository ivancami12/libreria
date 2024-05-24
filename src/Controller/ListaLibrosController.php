<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Bundle\DoctrineBundle\Controller;
use App\Entity\Books;

class ListaLibrosController extends AbstractController
{
    #[Route('libros', name: 'app_lista_libros')]
    public function index(ManagerRegistry $doctrine): Response

    {
        $entityManager = $doctrine->getManager();
        $libros = $entityManager->getRepository(Books::class)->FindAll();
        return $this->render('lista_libros/index.html.twig', [
            'controller_name' => 'ListaLibrosController',
            'libros' => $libros
        ]);
    }
    #[Route('vencidos', name: 'app_libros_vencidos')]
    public function lista(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $libros = $entityManager->getRepository(Books::class)->FindAll();
        return $this->render('lista_libros/lista_vencidos.html.twig', [
            'controller_name' => 'ListaLibrosController',
            'libros' => $libros

            $query = $Doctrine->createQuery(
                'SELECT p FROM App\Entity\Books  WHERE users_books.return_date Is null
                and  date(checkaout_date, '+7 day') <= DATE('now')');
            ->setParameter('precio', 50);
    
            $productos = $query->getResult();
        ]);
    }


}
