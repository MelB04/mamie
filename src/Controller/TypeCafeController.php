<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TypeCafeRepository;

class TypeCafeController extends AbstractController
{
    #[Route('/liste-typecafe', name: 'app_liste_typecafe')]
    public function listeTypecafe(TypeCafeRepository $typeCafeRepository): Response
    {
        $typesCafe = $typeCafeRepository->findAll();

        return $this->render('type_cafe/listeTypecafe.html.twig', [
            'typesCafe' => $typesCafe
        ]);
    }
}
