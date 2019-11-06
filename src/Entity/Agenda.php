<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Agenda
 *
 * @ORM\Table(name="agenda", uniqueConstraints={@ORM\UniqueConstraint(name="UN_PERIODO", columns={"INICIO", "FIM"})}, indexes={@ORM\Index(name="FK_PROFISSIONAL_AGENDA", columns={"ID_PROFISSIONAL"}), @ORM\Index(name="FK_CLIENTE_AGENDA", columns={"ID_CLIENTE"}), @ORM\Index(name="FK_USUARIO_AGENDA", columns={"ID_USUARIO"}), @ORM\Index(name="FK_SERVICO_AGENDA", columns={"ID_SERVICO"})})
 * @ORM\Entity
 */
class Agenda
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="INICIO", type="datetime", nullable=false, options={"comment"="Hora de início do serviço"})
     */
    private $inicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FIM", type="datetime", nullable=false, options={"comment"="Hora fim do serviço"})
     */
    private $fim;

    /**
     * @var string
     *
     * @ORM\Column(name="SITUACAO", type="string", length=1, nullable=false, options={"default"="A","fixed"=true,"comment"="Situação do agendamento. A: Aguardando; O: Confirmado; C: Cancelado"})
     */
    private $situacao = 'A';

    /**
     * @var string|null
     *
     * @ORM\Column(name="OBSERVACAO", type="text", length=65535, nullable=true)
     */
    private $observacao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ATUALIZACAO", type="datetime", nullable=false, options={"default"="0000-00-00 00:00:00","comment"="Registra a data e hora da última atualização."})
     */
    private $atualizacao = '0000-00-00 00:00:00';

    /**
     * @var \Cliente
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_CLIENTE", referencedColumnName="ID_CLIENTE")
     * })
     */
    private $cliente;

    /**
     * @var \Profissional
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Profissional")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_PROFISSIONAL", referencedColumnName="ID_PROFISSIONAL")
     * })
     */
    private $profissional;

    /**
     * @var \Servico
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Servico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_SERVICO", referencedColumnName="ID_SERVICO")
     * })
     */
    private $servico;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_USUARIO", referencedColumnName="ID_USUARIO")
     * })
     */
    private $usuario;

    public function getInicio($format = 'Y-m-d H:i:s')
    {
         return !empty($this->inicio) ? $this->inicio->format($format) : null;
    }

    public function setInicio($inicio)
    {
        $this->inicio = new \DateTime($inicio);

        return $this;
    }

    public function getFim($format = 'Y-m-d H:i:s')
    {
        return !empty($this->fim) ? $this->fim->format($format) : null;
    }

    public function setFim($fim)
    {
        $this->fim = new \DateTime($fim);

        return $this;
    }

    public function getSituacao(): ?string
    {
        return $this->situacao;
    }

    public function getNomeSituacao(): ?string
    {
        if ($this->situacao == 'A')
            return 'Aguardando';
        if ($this->situacao == 'O')
            return 'Confirmado';
        if ($this->situacao == 'C')
            return 'Cancelado';
    }

    public function setSituacao(string $situacao): self
    {
        $this->situacao = $situacao;

        return $this;
    }

    public function getObservacao(): ?string
    {
        return $this->observacao;
    }

    public function setObservacao(?string $observacao): self
    {
        $this->observacao = $observacao;

        return $this;
    }

    public function getAtualizacao(): ?\DateTimeInterface
    {
        return $this->atualizacao;
    }

    public function setAtualizacao($atualizacao)
    {
        $this->atualizacao = new \DateTime();

        return $this;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
        return $this;
    }

    /**
     * @return \Profissional
     */
    public function getProfissional()
    {
        return $this->profissional;
    }

    /**
     * @param \Profissional $profissional
     * @return Agenda
     */
    public function setProfissional($profissional)
    {
        $this->profissional = $profissional;
        return $this;
    }

    public function getServico()
    {
        return $this->servico;
    }

    /**
     * @param \Servico $servico
     * @return Agenda
     */
    public function setServico($servico)
    {
        $this->servico = $servico;
        return $this;
    }



    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getId();
    }


}
