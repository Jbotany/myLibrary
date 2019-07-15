<?php


namespace App\Services;


use App\Entity\Book;
use App\Entity\Publisher;
use App\Repository\PublisherRepository;
use Doctrine\ORM\EntityManagerInterface;

class BookPublisher
{
    private $em;
    private $publisherRepository;

    public function __construct(EntityManagerInterface $em, PublisherRepository $publisherRepository)
    {
        $this->em = $em;
        $this->publisherRepository = $publisherRepository;
    }

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

    private function checkPublisher(string $publisher): void
    {

    }
}