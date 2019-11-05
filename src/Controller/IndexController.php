<?php
namespace App\Controller;

use App\Entity\Agenda;
use App\Entity\Cliente;
use App\Entity\Profissional;
use App\Entity\Servico;
use App\Form\AgendaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class IndexController extends AbstractController
{
    /**
     * @Route("/", name="agendamento_index")
     */
    public function index()
    {
        $agendas = $this->getDoctrine()->getRepository(Agenda::class)->findAll();

        $data = [];
        foreach($agendas as $agenda) {
            $data[$agenda->getInicio('d/m/Y')][] = [
                'data_hora' => $agenda->getInicio('H:i') .' à ' . $agenda->getFim('H:i'),
                'cliente' => $agenda->getCliente()->getNome(),
                'servico' => $agenda->getServico()->getNome(),
                'profissional' => $agenda->getProfissional()->getNome(),
                'situacao' => $agenda->getNomeSituacao()
            ];
        }

        krsort($data);

        return $this->render('index/index.html.twig', ['agendas'=>$data]);
    }

    /**
     * @route("index/create", name="agendamento_create")
     */
    public function create(Request $request)
    {
        $agenda = new Agenda();

        $clientes = $this->getDoctrine()->getRepository(Cliente::class)->fetchPairs();
        $profissionais = $this->getDoctrine()->getRepository(Profissional::class)->fetchPairs();
        $servicos = $this->getDoctrine()->getRepository(Servico::class)->fetchPairs();

        $arDataAgenda = [];
        for ($i=1; $i<5; $i++) {
           $data = date('Y-m-d', mktime(0,0,0,date('m'),date('d')+$i,date('y')));
           for ($j=9; $j<20; $j++) {
               $arDataAgenda[$data][$data .' '. $j .':00'] = $j . ':00';
           }
        }

        $form   = $this->createForm(AgendaType::class, $agenda, [
            'clientes'=>$clientes, 'profissionais'=>$profissionais, 'servicos'=>$servicos, 'arDataAgenda'=>$arDataAgenda
        ]);

        // aplica as validações
        $form->handleRequest($request);

        // caso o formulário foi submetido e for válido
        if ($form->isSubmitted() && $form->isValid()) {

            // salva dos dados
            $em = $this->getDoctrine()->getManager();
            $em->persist($agenda);
            $em->flush();

            // envia mensagem de sucesso
            $this->get('session')->getFlashBag()->set('success', 'O Agendamento foi salvo com sucesso!!!');

            // redireciona para a página principal
            return $this->redirectToRoute('index_agendamento');
        }

        return $this->render('index/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}