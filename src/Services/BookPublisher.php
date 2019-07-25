<?php


namespace App\Services;


use App\Entity\Book;
use App\Entity\Publisher;
use App\Repository\PublisherRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Manage publisher of a book
 * Class BookPublisher
 * @package App\Services
 */
class BookPublisher
{
    private $em;
    private $publisherRepository;

    public function __construct(EntityManagerInterface $em, PublisherRepository $publisherRepository)
    {
        $this->em = $em;
        $this->publisherRepository = $publisherRepository;
    }

    /**
     * Add publisher in books
     * @param string $publisher
     * @param Book $book
     */
    public function setPublisher(string $publisher, Book $book): void
    {
        $currentPublisher = $this->publisherRepository->findOneBy(['name' => $publisher]);

        if (!$currentPublisher) {
            $newPublisher = new Publisher();
            $newPublisher->setName($publisher);
            $this->em->persist($newPublisher);
            $this->em->flush();
        }
        $book->setPublisher($currentPublisher);
    }

    /**
     * Check if publisher already exists
     * @param string $publisher
     */
    private function checkPublisher(string $publisher): void
    {
        //todo
    }
}