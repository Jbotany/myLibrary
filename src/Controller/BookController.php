<?php

namespace App\Controller;

use App\Entity\Library;
use App\Repository\BookRepository;
use App\Repository\LibraryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{

    private $bookRepository;
    private $libraryRepository;
    private $library;

    public function __construct(BookRepository $bookRepository, LibraryRepository $libraryRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->libraryRepository = $libraryRepository;
    }

    /**
     * @Route("/book", name="book")
     */
    public function index(Library $library, SessionInterface $session)
    {
        $books = $this->bookRepository->findBooksByLibrary($library);
        $currentLibrary = $session->get('library');

        return $this->render('book/index.html.twig', [
            'books' => $books,
            'currentLibrary' => $currentLibrary
        ]);
    }

    /**
     * @Route("/book/author", name="bookByAuthor")
     */
    public function booksByAuthor(Library $library)
    {
        $books = $this->bookRepository->findBooksByLibrary($library);
        $currentLibrary = $session->get('library');

        return $this->render('book/byAuthor.html.twig', [
            'books' => $books,
            'currentLibrary' => $currentLibrary
        ]);
    }


}
