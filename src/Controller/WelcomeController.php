<?php

namespace App\Controller;

use App\Repository\LibraryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{
    /**
     * @Route("/", name="welcome")
     */
    public function index(LibraryRepository $libraryRepository)
    {
        $libraries = $libraryRepository->findAll();

        return $this->render('welcome/index.html.twig', [
            'libraries' => $libraries
        ]);
    }
}
