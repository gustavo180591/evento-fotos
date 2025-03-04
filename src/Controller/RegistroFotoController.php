<?php

namespace App\Controller;

use App\Entity\RegistroFoto;
use App\Form\RegistroFotoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistroFotoController extends AbstractController
{

    #[Route('/', name: 'home_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('registro_foto/index.html.twig', [
            'title' => 'Bienvenido al Sistema de Registro de Fotos',
        ]);
    }
    #[Route('/registro/nueva', name: 'registro_nueva')]
    public function nueva(Request $request, EntityManagerInterface $entityManager): Response
    {
        $registroFoto = new RegistroFoto();
        $form = $this->createForm(RegistroFotoType::class, $registroFoto);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($registroFoto);
            $entityManager->flush();

            $this->addFlash('success', 'Registro exitoso. ¡Tu foto quedará guardada para la posteridad!');
            return $this->redirectToRoute('registro_nueva');
        }

        return $this->render('registro_foto/nueva.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/registro/lista', name: 'lista_foto')]
    public function lista(Request $request, EntityManagerInterface $entityManager): Response
    {
        $registroFotos = $entityManager->getRepository(RegistroFoto::class)->findAll();

        return $this->render('registro_foto/lista_foto.html.twig', [
            'registroFotos' => $registroFotos,
        ]);
    }
}

