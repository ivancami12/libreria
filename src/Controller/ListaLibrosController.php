<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Bundle\DoctrineBundle\Controller;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\Manager;
use App\Entity\UsersBooks;
use App\Entity\Addresses;
use App\Entity\Books;
use App\Entity\Users;

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
        //$libros = $entityManager->getRepository(Books::class)->FindAll();

        $prestamos_vencidos = $this->consultar_libros_vencidos($doctrine->getManager());
        $relacion = $this->cantidad_libros($doctrine->getManager());
        $descripcion = $this->descripcion_usuario($doctrine->getManager());

        return $this->render('lista_libros/libros.html.twig', [
            'controller_name' => 'ListaLibrosController',
            'prestamos_vencidos' => $prestamos_vencidos,
            'cantidad_libros'=> $relacion,
            'descripcion_usuario'=> $descripcion
        ]);
    }

    private function consultar_libros_vencidos($entityManager){
        $query = $entityManager->createQuery(
            "SELECT l
             FROM App\Entity\UsersBooks l
             WHERE l.return_date Is null
             and date_add(l.checkout_date, 7, 'day') <= CURRENT_DATE()"
        );
        return $query->getResult();
    }

    private function cantidad_libros($entityManager){
        $query = $entityManager->createQuery(
            "SELECT 
                CONCAT( 
                    SUM(CASE WHEN ub.id IS NOT NULL AND ub.return_date IS NULL THEN 1 ELSE 0 END),
                    '/',
                    SUM(CASE WHEN ub.id IS NULL OR ub.checkout_date IS NOT NULL THEN 1 ELSE 0 END))
            FROM App\Entity\Books b
            LEFT JOIN App\Entity\UsersBooks ub
                with b = ub.books
        ");
        return $query->getSingleScalarResult();
    }

    private function descripcion_usuario($entityManager){
        $query = $entityManager->createQuery(
            "SELECT  	
                    u.username,
                    a.street,
                    a.state,
                    b.title,
                    b.author,
                    ub.checkout_date 
            FROM    App\Entity\addresses a
            LEFT JOIN   App\Entity\users u
                WITH    a.user_id =  u.id 
            LEFT JOIN   App\Entity\books b
                WITH    u.id  = b.id 
            LEFT JOIN   App\Entity\UsersBooks ub
                WITH    b.id = ub.books
        ");
        return $query->getResult();
    }
}
