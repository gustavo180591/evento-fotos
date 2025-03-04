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
    #[Route('/registro/entregado/{id}', name: 'registro_foto_entregado')]
    public function entregado(RegistroFoto $registroFoto, EntityManagerInterface $entityManager): Response
    {
        $registroFoto->setEntregado(true);
        $entityManager->flush();

        $this->addFlash('success', 'Registro entregado con exito. ¡Ahora puedes entregar la foto!');
        return $this->redirectToRoute('lista_foto');
    }
    #[Route('/registro/editar/{id}', name: 'registro_editar')]
    public function editar(RegistroFoto $registroFoto, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RegistroFotoType::class, $registroFoto);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Registro editado con exito');
            return $this->redirectToRoute('lista_foto');
        }

        return $this->render('registro_foto/registro_editar.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/registro/eliminar/{id}', name: 'registro_eliminar')]
    public function eliminar(RegistroFoto $registroFoto, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($registroFoto);
        $entityManager->flush();

        $this->addFlash('success', 'Registro eliminado con exito');
        return $this->redirectToRoute('lista_foto');
    }
}

