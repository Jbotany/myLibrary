<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $toBuy;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $owned;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isRead;

    /**
     * @ORM\Column(type="string", length=4, nullable=true)
     */
    private $publishingYear;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $format;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $ISBN;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\StoragePlace", inversedBy="books")
     */
    private $storagePlace;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Translator", inversedBy="books")
     */
    private $translator;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Author", inversedBy="books")
     */
    private $authors;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Publisher", inversedBy="books")
     */
    private $publisher;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $summary;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Library", inversedBy="books")
     */
    private $libraries;

    public function __construct()
    {
        $this->authors = new ArrayCollection();
        $this->libraries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getToBuy(): ?bool
    {
        return $this->toBuy;
    }

    public function setToBuy(?bool $toBuy): self
    {
        $this->toBuy = $toBuy;

        return $this;
    }

    public function getOwned(): ?bool
    {
        return $this->owned;
    }

    public function setOwned(bool $owned): self
    {
        $this->owned = $owned;

        return $this;
    }

    public function getIsRead(): ?bool
    {
        return $this->isRead;
    }

    public function setIsRead(bool $isRead): self
    {
        $this->isRead = $isRead;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPublishingYear(): ?string
    {
        return $this->publishingYear;
    }

    public function setPublishingYear(?string $publishingYear): self
    {
        $this->publishingYear = $publishingYear;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(?string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getISBN(): ?string
    {
        return $this->ISBN;
    }

    public function setISBN(string $ISBN): self
    {
        $this->ISBN = $ISBN;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getStoragePlace(): ?StoragePlace
    {
        return $this->storagePlace;
    }

    public function setStoragePlace(?StoragePlace $storagePlace): self
    {
        $this->storagePlace = $storagePlace;

        return $this;
    }

    public function getTranslator(): ?Translator
    {
        return $this->translator;
    }

    public function setTranslator(?Translator $translator): self
    {
        $this->translator = $translator;

        return $this;
    }

    /**
     * @return Collection|Author[]
     */
    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    public function addAuthors(Author $author): self
    {
        if (!$this->authors->contains($author)) {
            $this->authors[] = $author;
        }

        return $this;
    }

    public function removeAuthors(Author $author): self
    {
        if ($this->authors->contains($author)) {
            $this->authors->removeElement($author);
        }

        return $this;
    }

    public function getPublisher(): ?Publisher
    {
        return $this->publisher;
    }

    public function setPublisher(?Publisher $publisher): self
    {
        $this->publisher = $publisher;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * @return Collection|Library[]
     */
    public function getLibraries(): Collection
    {
        return $this->libraries;
    }

    public function addLibrary(Library $library): self
    {
        if (!$this->libraries->contains($library)) {
            $this->libraries[] = $library;
        }

        return $this;
    }

    public function removeLibrary(Library $library): self
    {
        if ($this->libraries->contains($library)) {
            $this->libraries->removeElement($library);
        }

        return $this;
    }
}
