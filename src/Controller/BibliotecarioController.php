<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Books;

class BibliotecarioController extends AbstractController
{
    #[Route('', name: 'app_lista_libros')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $libros = $entityManager->getRepository(Books::class)->FindAll();
        return $this->render('bibliotecario/books.twig', [
            'controller_name' => 'BibliotecarioController',
            'libros' => $libros
        ]);
    }
    
    #[Route('vencidos', name: 'app_libros_vencidos')]
    public function lista(ManagerRegistry $doctrine): Response
    {
        //$libros = $entityManager->getRepository(Books::class)->FindAll();

        $prestamos_vencidos = $this->consultar_libros_vencidos($doctrine->getManager());
        $relacion = $this->cantidad_libros($doctrine->getManager());
        return $this->render('bibliotecario/dashboard.twig', [
            'controller_name' => 'BibliotecarioController',
            'prestamos_vencidos' => $prestamos_vencidos,
            'cantidad_libros'=> $relacion
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
    
    #[Route('vencidos/{id}',  name: 'app_descripcion')]
    public function descri(ManagerRegistry $doctrine, $id): Response
    {
        $descripcion = $this->descripcion_usuarios($doctrine->getManager(), $id);
        return new JsonResponse($descripcion);
    }

    private function descripcion_usuarios($entityManager, $id){
        $result = $entityManager->createQuery(
            "SELECT ub.id,
                    u.username,
                    a.street,
                    a.state,
                    b.title,
                    b.author,
                    ub.checkout_date 
            FROM App\Entity\UsersBooks ub
            LEFT JOIN App\Entity\Users u 
                WITH	ub.users = u
            LEFT JOIN App\Entity\Books b 
                WITH	ub.books = b
            LEFT JOIN App\Entity\Addresses a 
                WITH u.addresses = a
            WHERE ub.id = :id
        ");
        $result->setParameter('id', $id);
        return json_encode($result->getSingleResult());
    }
}
    

