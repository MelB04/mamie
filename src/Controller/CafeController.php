<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AjoutCafeType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Cafe;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CafeRepository;

class CafeController extends AbstractController
{
    
    #[Route('/liste-cafes', name: 'app_liste_cafe')]
    public function listeCafes(CafeRepository $cafeRepository): Response
    {
        $cafes = $cafeRepository->findAll();

        return $this->render('cafe/listeCafes.html.twig', [
            'cafes' => $cafes
        ]);
    }


    #[Route('/ajoutCafe', name: 'app_ajoutCafe')]
    public function ajoutCafe(Request $request, EntityManagerInterface $em): Response
    {
        $cafe = new Cafe();
        $form = $this->createForm(AjoutCafeType::class, $cafe);

        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $em->persist($cafe);
                $em->flush();

                $this->addFlash('notice','Café créé');
                return $this->redirectToRoute('app_ajoutCafe');
            }
        }

        return $this->render('cafe/ajoutCafe.html.twig', [
            'form' => $form->createView()
        ]);
    }


}
