<?php


namespace App\Services;


use App\Entity\Author;
use App\Entity\Book;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;

class BookAuthors
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function setAuthors(array $bookAuthors, AuthorRepository $authorRepository, Book $book): void
    {
        $authors = self::checkAuthors($bookAuthors, $authorRepository);

        foreach ($authors as $author) {
            $existingAuthor = $authorRepository->findOneBy(['author' => $author]);
            $book->addAuthors($existingAuthor);
        }
    }

    private function checkAuthors(
        array $bookAuthors,
        AuthorRepository $authorRepository
    ) : array
    {
        $authors = [];
        foreach ($bookAuthors as $author) {
            $existingAuthor = $authorRepository->findOneBy(['author' => $author]);
            if (!$existingAuthor) {
                $newAuthor = new Author();
                $newAuthor->setAuthor($author);
                $this->em->persist($newAuthor);
                $this->em->flush();
            }
            $authors[] = $author;
        }

        return $authors;
    }
}