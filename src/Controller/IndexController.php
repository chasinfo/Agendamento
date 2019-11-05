<?php
namespace App\Controller;

use App\Entity\Agenda;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Agenda::class);
        $agendas = $repository->findAll();

        $data = [];
        foreach($agendas as $agenda) {
            $data[($agenda->getInicio()->format('d/m/Y'))][] = [
                'data_hora' => $agenda->getInicio()->format('H:i') .' à ' . $agenda->getFim()->format('H:i'),
                'cliente' => $agenda->getCliente()->getNome(),
                'servico' => $agenda->getServico()->getNome(),
                'profissional' => $agenda->getProfissional()->getNome(),
                'situacao' => $agenda->getNomeSituacao()
            ];
        }

         krsort($data);

        return $this->render('index/index.html.twig', ['agendas'=>$data]);
    }
}