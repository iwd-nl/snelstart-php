<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

use Money\Money;

use SnelstartPHP\Model\Type\ProcesStatus;
use SnelstartPHP\Model\Type\VerkooporderBtwIngaveModel;
use SnelstartPHP\Model\Verkoopboeking;

class Verkooporder extends SnelstartObject
{
    /**
     * @var array
     */
    private $relatie;

    /**
     * @var ProcesStatus
     */
    private $procesStatus;

    /**
     * @var int
     */
    private $nummer;

    /**
     * @var \DateTimeInterface|null
     */
    private $modifiedOn;

    /**
     * @var \DateTimeInterface|null
     */
    private $datum;

    /**
     * @var int
     */
    private $krediettermijn;

    /**
     * @var string
     */
    private $omschrijving;

    /**
     * @var string
     */
    private $betalingskenmerk;

    /**
     * @var IncassoMachtiging|null
     */
    private $incassomachtiging;

    /**
     * @var VerkooporderAfleverAdres
     */
    private $afleveradres;

    /**
     * @var VerkooporderFactuurdres
     */
    private $factuuradres;

    /**
     * @var string
     */
    private $verkooporderBtwIngaveModel;

    /**
     * @var Kostenplaats
     */
    private $kostenplaats;

    /**
     * @var VerkooporderRegel[]
     */
    private $regels;

    /**
     * @var string
     */
    private $memo;

    /**
     * @var string
     */
    private $orderreferentie;

    /**
     * @var Money|null $factuurkorting
     */
    private $factuurkorting;

    /**
     * @var Verkoopboeking
     */
    private $verkoopfactuur;


    public static $editableAttributes = [
        'id',
        'relatie',
        'procesStatus',
        'nummer',
        'modifiedOn',
        'datum',
        'krediettermijn',
        'omschrijving',
        'betalingskenmerk',
        'incassomachtiging',
        'afleveradres',
        'factuuradres',
        'verkooporderBtwIngaveModel',
        'kostenplaats',
        'regels',
        'memo',
        'orderreferentie',
        'factuurkorting',
        'verkoopfactuur',
    ];

    /**
     * @return Relatie|null
     */
    public function getRelatie(): ?Relatie
    {
        return $this->relatie;
    }

    /**
     * @param Relatie $relatie
     * @return Verkooporder
     */
    public function setRelatie(Relatie $relatie): self
    {
        $this->relatie = $relatie;

        return $this;
    }

    /**
     * @return null|ProcesStatus
     */
    public function getProcesStatus(): ?ProcesStatus
    {
        return $this->procesStatus;
    }

    /**
     * @param null|ProcesStatus $procesStatus
     * @return Verkooporder
     */
    public function setProcesStatus(?ProcesStatus $procesStatus): self
    {
        $this->procesStatus = $procesStatus;

        return $this;
    }

    /**
     * @return int
     */
    public function getNummer(): int
    {
        return $this->nummer;
    }

    /**
     * @param int $nummer
     * @return Verkooporder
     */
    public function setNummer(?int $nummer): self
    {
        $this->nummer = $nummer ?? $this->nummer;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getModifiedOn(): ?\DateTimeInterface
    {
        return $this->modifiedOn;
    }

    /**
     * @param \DateTimeInterface|null $modifiedOn
     * @return Relatie
     */
    public function setModifiedOn(?\DateTimeInterface $modifiedOn): self
    {
        $this->modifiedOn = $modifiedOn;

        return $this;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(?\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    /**
     * @return int
     */
    public function getKrediettermijn(): int
    {
        return $this->krediettermijn;
    }

    /**
     * @param int $krediettermijn
     * @return Verkooporder
     */
    public function setKrediettermijn(?int $krediettermijn): self
    {
        $this->krediettermijn = $krediettermijn ?? $this->krediettermijn;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    /**
     * @param string|null $omschrijving
     * @return Verkooporder
     */
    public function setOmschrijving(?string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBetalingskenmerk(): ?string
    {
        return $this->betalingskenmerk;
    }

    /**
     * @param string|null $betalingskenmerk
     * @return Verkooporder
     */
    public function setBetalingskenmerk(?string $betalingskenmerk): self
    {
        $this->betalingskenmerk = $betalingskenmerk;

        return $this;
    }

    /**
     * @return IncassoMachtiging|null
     */
    public function getIncassoMachtiging(): ?IncassoMachtiging
    {
        return $this->incassomachtiging;
    }

    public function setIncassoMachtiging(?IncassoMachtiging $incassomachtiging): self
    {
        $this->incassomachtiging = $incassomachtiging;

        return $this;
    }

    /**
     * @return VerkooporderAfleverAdres
     */
    public function getAfleveradres(): VerkooporderAfleverAdres
    {
        return $this->afleveradres ?? new VerkooporderAfleverAdres();
    }

    /**
     * @param VerkooporderAfleverAdres $afleverAdres
     * @return Verkooporder
     */
    public function setAfleveradres(VerkooporderAfleverAdres $afleverAdres): self
    {
        $this->afleveradres = $afleverAdres;

        return $this;
    }

    /**
     * @return VerkooporderFactuurdres
     */
    public function getFactuurAdres(): VerkooporderFactuurdres
    {
        return $this->factuuradres ?? new VerkooporderFactuurdres();
    }

    /**
     * @param VerkooporderFactuurdres $factuurAdres
     * @return Verkooporder
     */
    public function setFactuurAdres(VerkooporderFactuurdres $factuurAdres): self
    {
        $this->factuuradres = $factuurAdres;

        return $this;
    }

    /**
     * @return null|VerkooporderBtwIngaveModel
     */
    public function getVerkooporderBtwIngaveModel(): ?VerkooporderBtwIngaveModel
    {
        return $this->procesStatus;
    }

    /**
     * @param null|VerkooporderBtwIngaveModel $verkooporderBtwIngaveModel
     * @return Verkooporder
     */
    public function setVerkooporderBtwIngaveModel(?VerkooporderBtwIngaveModel $verkooporderBtwIngaveModel): self
    {
        $this->verkooporderBtwIngaveModel = $verkooporderBtwIngaveModel;

        return $this;
    }


    /**
     * @return Kostenplaats
     */
    public function getKostenplaats(): ?Kostenplaats
    {
        return $this->kostenplaats;
    }

    /**
     * @param Kostenplaats $kostenplaats
     * @return Boekingsregel
     */
    public function setKostenplaats(Kostenplaats $kostenplaats): self
    {
        $this->kostenplaats = $kostenplaats;

        return $this;
    }


    /**
     * @return VerkooporderRegel[]
     */
    public function getRegels(): array
    {
        return $this->regels ?? [];
    }

    /**
     * @param array $regels
     *
     * @return Verkooporder
     */
    public function setRegels(array $regels): self
    {
        foreach ($regels as $regel) {
            if (!$regel instanceof VerkooporderRegel) {
                throw new \InvalidArgumentException(sprintf("Should be a type of '%s'", VerkooporderRegel::class));
            }
        }

        $this->regels = $regels;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMemo(): ?string
    {
        return $this->memo;
    }

    /**
     * @param string|null $memo
     * @return Verkooporder
     */
    public function setMemo(?string $memo): self
    {
        $this->memo = $memo;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOrderreferentie(): ?string
    {
        return $this->orderreferentie;
    }

    /**
     * @param string|null $orderreferentie
     * @return Verkooporder
     */
    public function setOrderreferentie(?string $orderreferentie): self
    {
        $this->orderreferentie = $orderreferentie;

        return $this;
    }

    /**
     * @return Money
     */
    public function getFactuurkorting(): Money
    {
        return $this->factuurkorting;
    }

    /**
     * @param Money $factuurkorting
     * @return Verkooporder
     */
    public function setFactuurkorting(Money $factuurkorting): self
    {
        $this->factuurkorting = $factuurkorting;

        return $this;
    }

    /**
     * @return Verkoopboeking
     */
    public function getVerkoopfactuur(): Verkoopboeking
    {
        return $this->verkoopfactuur;
    }

    /**
     * @param Verkoopboeking $verkoopfactuur
     * @return Verkooporder
     */
    public function setVerkoopfactuur(Verkoopboeking $verkoopfactuur): self
    {
        $this->verkoopfactuur = $verkoopfactuur;

        return $this;
    }

}
