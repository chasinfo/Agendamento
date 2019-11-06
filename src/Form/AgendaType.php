<?php

namespace App\Form;

use App\Entity\Agenda;
use App\Entity\Cliente;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgendaType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $clientes = $options['clientes'];
        $profissionais = $options['profissionais'];
        $servicos = $options['servicos'];
        $arDataAgenda = $options['arDataAgenda'];

        $builder
            ->add('cliente', ChoiceType::class, [
                'label' => 'Cliente',
                'placeholder' => '',
                'choices'=>$clientes,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])

            ->add('profissional', ChoiceType::class, [
                'label' => 'Profissional',
                'placeholder' => '',
                'choices'=>$profissionais,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])

            ->add('servico', ChoiceType::class, [
                'label' => 'Servico',
                'placeholder' => '',
                'choices'=>$servicos,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])

            ->add('inicio', ChoiceType::class, [
                'label' => 'Início',
                'placeholder' => '',
                'choices'=>$arDataAgenda,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('fim', ChoiceType::class, [
                'label' => 'Fim',
                'placeholder' => '',
                'choices'=>$arDataAgenda,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('situacao', ChoiceType::class, [
                'label' => 'Situação',
                'placeholder' => '',
                'choices'=> ['Aguardando'=>'A', 'Confirmado'=>'O', 'Cancelado'=>'C'],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('observacao', null, [
                'label' => 'Observação',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('enviar', SubmitType::class, [
                'label'=>'Salvar',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Agenda::class,
            'clientes' => [],
            'profissionais' => [],
            'servicos' => [],
            'arDataAgenda' => []
        ]);
    }
}
