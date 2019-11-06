<?php
namespace App\Controller;

use App\Entity\Agenda;
use App\Entity\Cliente;
use App\Entity\Profissional;
use App\Entity\Servico;
use App\Entity\Usuario;
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
                'situacao' => $agenda->getNomeSituacao(),
                'id_cliente' => $agenda->getCliente()->getId(),
                'id_servico' => $agenda->getServico()->getId(),
                'id_profissional' => $agenda->getProfissional()->getId()
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
        $clientes     = $this->getDoctrine()->getRepository(Cliente::class)->fetchPairs();
        $profissionais = $this->getDoctrine()->getRepository(Profissional::class)->fetchPairs();
        $servicos     = $this->getDoctrine()->getRepository(Servico::class)->fetchPairs();
        $arDataAgenda = [];

        for ($i=1; $i<5; $i++) {
           $data = date('Y-m-d', mktime(0,0,0,date('m'),date('d')+$i,date('y')));
           $dataPtBr = date('d/m/Y', strtotime($data));
           for ($j=9; $j<20; $j++) {
               $arDataAgenda[$dataPtBr][$dataPtBr .' '. $j .':00'] = $data .' '. $j .':00';
           }
        }

        $agenda = new Agenda();
        $form   = $this->createForm(AgendaType::class, $agenda, [
            'clientes'=>$clientes, 'profissionais'=>$profissionais, 'servicos'=>$servicos, 'arDataAgenda'=>$arDataAgenda
        ]);

        $requestAgenda = $request->request->get('agenda');

        if ($requestAgenda) {
            $cliente = $this->getDoctrine()->getManager()->getReference(Cliente::class, $requestAgenda['cliente']);
            $profissional = $this->getDoctrine()->getManager()->getReference(Profissional::class, $requestAgenda['profissional']);
            $servico = $this->getDoctrine()->getManager()->getReference(Servico::class, $requestAgenda['servico']);
            $usuario = $this->getDoctrine()->getManager()->getReference(Usuario::class, 4);

            // aplica as validações
            $form->handleRequest($request);

            // caso o formulário foi submetido e for válido
            if ($form->isSubmitted() && $form->isValid()) {

                $agenda->setCliente($cliente);
                $agenda->setServico($servico);
                $agenda->setProfissional($profissional);
                $agenda->setAtualizacao(new \DateTime());
                $agenda->setUsuario($usuario);

                // salva dos dados
                $em = $this->getDoctrine()->getManager();
                $em->persist($agenda);
                $em->flush();

                // envia mensagem de sucesso
                $this->addFlash('success', 'O Agendamento foi salvo com sucesso!!!');

                // redireciona para a página principal
                return $this->redirectToRoute('agendamento_index');
            }
        }

        return $this->render('index/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("index/editar/{cliente}/{servico}/{profissional}", name="agendamento_editar")
     */
    public function update(Request $request, $cliente, $servico, $profissional)
    {
        $em = $this->getDoctrine()->getManager();

        $agenda = $em->getRepository(Agenda::class)->findOneBy([
            'cliente' => $cliente,
            'servico' => $servico,
            'profissional' => $profissional
        ]);


        $clientes     = $this->getDoctrine()->getRepository(Cliente::class)->fetchPairs();
        $profissionais = $this->getDoctrine()->getRepository(Profissional::class)->fetchPairs();
        $servicos     = $this->getDoctrine()->getRepository(Servico::class)->fetchPairs();
        $arDataAgenda = [];

        for ($i=1; $i<5; $i++) {
            $data = date('Y-m-d', mktime(0,0,0,date('m'),date('d')+$i,date('y')));
            $dataPtBr = date('d/m/Y', strtotime($data));
            for ($j=9; $j<20; $j++) {
                $arDataAgenda[$dataPtBr][$dataPtBr .' '. $j .':00'] = $data .' '. $j .':00';
            }
        }

        $form   = $this->createForm(AgendaType::class, $agenda, [
            'clientes'=>$clientes, 'profissionais'=>$profissionais, 'servicos'=>$servicos, 'arDataAgenda'=>$arDataAgenda
        ]);

        $requestAgenda = $request->request->get('agenda');

        if ($requestAgenda) {
            $cliente = $this->getDoctrine()->getManager()->getReference(Cliente::class, $requestAgenda['cliente']);
            $profissional = $this->getDoctrine()->getManager()->getReference(Profissional::class, $requestAgenda['profissional']);
            $servico = $this->getDoctrine()->getManager()->getReference(Servico::class, $requestAgenda['servico']);
            $usuario = $this->getDoctrine()->getManager()->getReference(Usuario::class, 4);

            // aplica as validações
            $form->handleRequest($request);

            // caso o formulário foi submetido e for válido
            if ($form->isSubmitted() && $form->isValid()) {

                $agenda->setCliente($cliente);
                $agenda->setServico($servico);
                $agenda->setProfissional($profissional);
                $agenda->setAtualizacao(new \DateTime());
                $agenda->setUsuario($usuario);

                // salva dos dados
                $em = $this->getDoctrine()->getManager();
                $em->persist($agenda);
                $em->flush();

                // envia mensagem de sucesso
                $this->addFlash('success', 'O Agendamento alterado com sucesso!!!');

                // redireciona para a página principal
                return $this->redirectToRoute('agendamento_index');
            }
        }

        return $this->render('index/update.html.twig', [
            'agenda' => $agenda,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("index/delete/{cliente}/{servico}/{profissional}", name="agendamento_delete")
     */
    public function delete(Request $request, $cliente, $servico, $profissional)
    {
        $em = $this->getDoctrine()->getManager();

        $agenda = $em->getRepository(Agenda::class)->findOneBy([
            'cliente' => $cliente,
            'servico' => $servico,
            'profissional' => $profissional
        ]);

        $em->remove($agenda);
        $em->flush();

        // envia mensagem de sucesso
        $this->addFlash('success', 'O Agendamento excluído com sucesso!!!');

        // redireciona para a página principal
        return $this->redirectToRoute('agendamento_index');
    }
}