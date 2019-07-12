<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{

    private $bookRepository;

    public function __construct(
        BookRepository $bookRepository
    ) {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @Route("/book", name="book")
     */
    public function index()
    {
        $books = $this->bookRepository->findAll();

        return $this->render('book/index.html.twig', [
            'books' => $books,
        ]);
    }

    /**
     * @Route("/book/author", name="bookByAuthor")
     */
    public function booksByAuthor()
    {
        $books = $this->bookRepository->findAll();


        return $this->render('book/byAuthor.html.twig', [
            'books' => $books,
        ]);
    }


}
