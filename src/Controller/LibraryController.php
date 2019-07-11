<?php

namespace App\Controller;

use App\Entity\Library;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController
{
    /**
     * @Route("/library/{id}", name="library")
     */
    public function index(Library $library, SessionInterface $session)
    {
        $session->set('library', $library);

        return $this->render('library/index.html.twig', [
            'currentLibrary' => $library
        ]);
    }
}
