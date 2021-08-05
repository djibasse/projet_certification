<?php

namespace App\Controller;

use App\Entity\Chambre;
use App\Form\ChambreType;
use App\Repository\ChambreRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog')]

    public function index(ChambreRepository $repo): Response
    {
        $chambres = $repo->findAll();
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'chambres' =>$chambres
        ]);
    }
    /**
     * @Route("/", name = "accueil")
     */
    public function accueil(){
        return $this->render('blog/accueil.html.twig');
    }

    
}
