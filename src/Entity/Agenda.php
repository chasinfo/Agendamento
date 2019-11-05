<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="INICIO", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP","comment"="Hora de início do serviço"})
     */
    private $inicio = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FIM", type="datetime", nullable=false, options={"default"="0000-00-00 00:00:00","comment"="Hora fim do serviço"})
     */
    private $fim = '0000-00-00 00:00:00';

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
    private $idUsuario;

    public function getInicio(): ?\DateTimeInterface
    {
        return $this->inicio;
    }

    public function setInicio(\DateTimeInterface $inicio): self
    {
        $this->inicio = $inicio;

        return $this;
    }

    public function getFim(): ?\DateTimeInterface
    {
        return $this->fim;
    }

    public function setFim(\DateTimeInterface $fim): self
    {
        $this->fim = $fim;

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

    public function setAtualizacao(\DateTimeInterface $atualizacao): self
    {
        $this->atualizacao = $atualizacao;

        return $this;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(\Cliente $cliente): Agenda
    {
        $this->cliente = $cliente;
        return $this;
    }

    /**
     * @return \Profissional
     */
    public function getProfissional(): ?Profissional
    {
        return $this->profissional;
    }

    /**
     * @param \Profissional $profissional
     * @return Agenda
     */
    public function setProfissional(\Profissional $profissional): Agenda
    {
        $this->profissional = $profissional;
        return $this;
    }

    public function getServico(): ?Servico
    {
        return $this->servico;
    }

    /**
     * @param \Servico $servico
     * @return Agenda
     */
    public function setServico(\Servico $servico): Agenda
    {
        $this->servico = $servico;
        return $this;
    }



    public function getIdUsuario(): ?Usuario
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(?Usuario $idUsuario): self
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }


}
