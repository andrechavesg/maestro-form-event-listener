<?php

namespace App\Controller;

use App\Entity\Responsavel;
use app\Entity\ResponsavelVivenda;
use App\Entity\Investidor;
use App\Form\InvestidorType;
use App\Form\VisitaDomiciliarType;
use App\Repository\VisitaDomiciliarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cadastro")
 */
class CadastroController extends AbstractController
{
    /**
     * @Route("/", name="cadastro_index", methods={"GET"})
     */
    public function index(): Response
    {
        $form = $this->createForm(InvestidorType::class);

        return $this->render('cadastro/index.html.twig', ["formDeCadastro" => $form->createView()]);
    }

    /**
     * @Route("/", name="cadastro_envia", methods={"POST"})
     */
    public function envia(Request $request): Response
    {
        $form = $this->createForm(InvestidorType::class);

        $form->handleRequest($request);

        if($form->isValid()) {
            $investidor = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($investidor);

            return $this->redirectToRoute("cadastro_index");
        }

        return $this->render('cadastro/index.html.twig', ["formDeCadastro" => $form->createView()]);
    }
}
