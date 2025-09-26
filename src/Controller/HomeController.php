<?php

namespace App\Controller;

use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/add_book', name: 'app_add_book')]
    public function addBook(EntityManagerInterface $entityManager): Response
    {
        $add_book = new Book();
        $add_book->setTitle('Le Rouge et le Noir');
        // tell Doctrine you want to (eventually) save the add_book (no queries yet)
        $entityManager->persist($add_book);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Nouveau livre ajouté avec l id '.$add_book->getId());
    }

}
