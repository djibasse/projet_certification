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

    #[Route('/blog/create', name: 'creation_chambre')]
    
    public function create( Request $request): Response{
        $chambre = new Chambre();

        $form = $this->createForm(ChambreType::class, $chambre);

       $form->handleRequest($request);

       if($form->isSubmitted()&&$form->isValid()){

           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->persist($chambre);
           $entityManager-> flush();

           Return $this->redirectToRoute('chambre');
       }

       return $this->render ("blog/create.html.twig",[
           'formChambre'=> $form->createView()
           ]);
  }


}
