<?php

namespace App\Controller;

use App\Repository\BookRepository;
use App\Repository\LibraryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{

    private $bookRepository;
    private $libraryRepository;

    public function __construct(BookRepository $bookRepository, LibraryRepository $libraryRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->libraryRepository = $libraryRepository;

    }

    /**
     * @Route("/book", name="book")
     */
    public function index()
    {
        $books = $this->bookRepository->findBy([], ['title' => 'ASC']);
        $library = $this->libraryRepository->findOneBy(['id' => 1]);

        return $this->render('book/index.html.twig', [
            'books' => $books,
            'library' => $library
        ]);
    }

    /**
     * @Route("/book/author", name="bookByAuthor")
     */
    public function booksByAuthor()
    {
        $books = $this->bookRepository->findAll();
        $library = $this->libraryRepository->findOneBy(['id' => 1]);

        return $this->render('book/byAuthor.html.twig', [
            'books' => $books,
            'library' => $library
        ]);
    }


}
