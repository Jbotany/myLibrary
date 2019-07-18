<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookISBNType;
use App\Form\BookType;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use App\Services\APIGoogle;
use App\Services\APIMixer;
use App\Services\APIOpenLibrary;
use App\Services\BookAuthors;
use App\Services\BookPublisher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/book")
 */
class BookController extends AbstractController
{
    const COVERPLACEHOLDER = "https://d827xgdhgqbnd.cloudfront.net/wp-content/uploads/2016/04/09121712/book-cover-placeholder.png";

    /**
     * @Route("/", name="book_index", methods={"GET"})
     */
    public function index(BookRepository $bookRepository): Response
    {
        return $this->render('book/index.html.twig', [
            'books' => $bookRepository->findBy([],['title'=> 'ASC']),
        ]);
    }

    /**
     * @Route("/new", name="book_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('book_index');
        }

        return $this->render('book/new.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/newISBN", name="book_newISBN", methods={"GET","POST"})
     */
    public function newISBN(
        Request $request,
        AuthorRepository $authorRepository,
        BookAuthors $bookAuthors,
        BookPublisher $bookPublisher,
        APIMixer $APIMixer
    ): Response
    {
        $book = new Book();
        $form = $this->createForm(BookISBNType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $isbn = $form->getData()->getISBN();

            $bookInfos = $APIMixer->mixAPIResults($isbn);

            if (!empty($bookInfos)) {
                $title = $bookInfos['title'];

                $bookAuthors->setAuthors($bookInfos['authors'], $authorRepository, $book);

                $publishedAt = $bookInfos['publishedAt'] ?? null;
                $description = $bookInfos['description'] ?? null;
                $cover = $bookInfos['cover'] ?? null;

                if (isset($bookInfos['publisher'])) {
                    $publisher = $bookInfos['publisher'];
                    $bookPublisher->setPublisher($publisher, $book);
                }

                $book->setTitle($title);
                $book->setPublishedAt($publishedAt);
                $book->setSummary($description);

                if ($cover) {
                    $book->setCover($cover);
                } else {
                    $book->setCover(self::COVERPLACEHOLDER);
                }


                $entityManager->persist($book);
                $entityManager->flush();

                return $this->redirectToRoute('book_index');
            } else {
                $this->addFlash('danger', 'ISBN inconnu');
            }
        }

        return $this->render('book/newISBN.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/unread", name="book_unread", methods={"GET"})
     */
    public function showUnread(BookRepository $bookRepository): Response
    {
        return $this->render('book/unread.html.twig', [
            'books' => $bookRepository->findBy(['isRead' => false]),
        ]);
    }

    /**
     * @Route("/read", name="book_read", methods={"GET"})
     */
    public function showRead(BookRepository $bookRepository): Response
    {
        return $this->render('book/read.html.twig', [
            'books' => $bookRepository->findBy(['isRead' => true]),
        ]);
    }


    /**
     * @Route("/{id}", name="book_show", methods={"GET"})
     */
    public function show(Book $book): Response
    {
        return $this->render('book/show.html.twig', [
            'book' => $book,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="book_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Book $book): Response
    {
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('book_index', [
                'id' => $book->getId(),
            ]);
        }

        return $this->render('book/edit.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="book_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Book $book): Response
    {
        if ($this->isCsrfTokenValid('delete' . $book->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($book);
            $entityManager->flush();
        }

        return $this->redirectToRoute('book_index');
    }
}
