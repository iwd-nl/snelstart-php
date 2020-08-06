<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Model\V1;

use Money\Money;
use SnelstartPHP\Model\Adres;
use SnelstartPHP\Model\EmailVersturen;
use SnelstartPHP\Model\SnelstartObject;
use SnelstartPHP\Model\Type as Types;

/**
 * @deprecated
 */
final class Relatie extends SnelstartObject
{
    /**
     * Datum waarop de gegevens van deze relatie zijn aangepast
     *
     * @var \DateTimeInterface|null
     */
    private $modifiedOn;

    /**
     * @see Types\Relatiesoort
     * @var Types\Relatiesoort[]
     */
    private $relatiesoort;

    /**
     * Het relatienummer
     *
     * @var int|null
     */
    private $relatiecode = 0;

    /**
     * De volledige naam van de relatie.
     *
     * @var string
     */
    private $naam;

    /**
     * @var Adres|null
     */
    private $vestigingsAdres;

    /**
     * @var Adres|null
     */
    private $correspondentieAdres;

    /**
     * Het telefoonnummer van de relatie.
     *
     * @var string|null
     */
    private $telefoon;

    /**
     * Het mobiele nummer van de relatie.
     *
     * @var string|null
     */
    private $mobieleTelefoon;

    /**
     * Het hoofd-emailadres van de relatie.
     *
     * @var string|null
     */
    private $email;

    /**
     * Het BTW-nummer van de relatie.
     *
     * @var string|null
     */
    private $btwNummer;

    /**
     * De standaard factuurkorting die aan deze relatie wordt gegeven (optioneel).
     *
     * @var Money|null
     */
    private $factuurkorting;

    /**
     * @var int
     */
    private $krediettermijn = 0;

    /**
     * Geeft true terug als Types\IncassoSoort Core of B2B is.
     * Dit veld komt overeen met het veld Betaalopdracht in SnelStart Desktop
     *
     * @see Types\Incassosoort
     * @var bool
     */
    private $bankieren = false;

    /**
     * Een vlag dat aangeeft of een relatie niet meer actief is binnen de administratie.
     * Indien true, dan kan de relatie als "verwijderd" worden beschouwd.
     *
     * @var bool
     */
    private $nonactief = false;

    /**
     * Het standaard kredietlimiet (in €) van aan deze relatie wordt gegeven (optioneel).
     *
     * @var Money|null
     */
    private $kredietLimiet;

    /**
     * @var string|null
     */
    private $memo;

    /**
     * Het nummer van de Kamer van Koophandel van de relatie.
     *
     * @var string|null
     */
    private $kvkNummer;

    /**
     * De URL van de website van de relatie.
     *
     * @var string|null
     */
    private $websiteUrl;

    /**
     * Het soort aanmaning dat van toepassing is op de relatie (optioneel).
     *
     * @see Types\Aanmaningsoort
     * @var Types\Aanmaningsoort|null
     */
    private $aanmaningsoort;

    /**
     * De emailgegevens voor het versturen van offertes.
     *
     * @var EmailVersturen|null
     */
    private $offerteEmailVersturen;

    /**
     * De emailgegevens voor het versturen van bevestigingen.
     *
     * @var EmailVersturen|null
     */
    private $bevestigingsEmailVersturen;

    /**
     * De emailgegevens voor het versturen van facturen.
     *
     * @var EmailVersturen|null
     */
    private $factuurEmailVersturen;

    /**
     * De emailgegevens voor het versturen van aanmaningen.
     *
     * @var EmailVersturen|null
     */
    private $aanmaningEmailVersturen;

    /**
     * Een vlag dat aangeeft of een UBL-bestand als bijlage bij een email moet worden toegevoegd bij het versturen van facturen.
     *
     * @var bool
     */
    private $ublBestandAlsBijlage = true;

    /**
     * @var string|null
     */
    private $iban;

    /**
     * @var string|null
     */
    private $bic;

    /**
     * @var Types\Incassosoort|null
     */
    private $incassoSoort;

    /**
     * @var string|null
     */
    private $inkoopBoekingenUri;

    /**
     * @var string|null
     */
    private $verkoopBoekingenUri;

    public static $editableAttributes = [
        "id",
        "modifiedOn",
        "relatiesoort",
        "relatiecode",
        "naam",
        "vestigingsAdres",
        "correspondentieAdres",
        "telefoon",
        "mobieleTelefoon",
        "email",
        "btwNummer",
        "factuurkorting",
        "krediettermijn",
        "bankieren",
        "nonactief",
        "kredietLimiet",
        "memo",
        "kvkNummer",
        "websiteUrl",
        "aanmaningsoort",
        "offerteEmailVersturen",
        "bevestigingsEmailVersturen",
        "factuurEmailVersturen",
        "aanmaningEmailVersturen",
        "ublBestandAlsBijlage",
        "iban",
        "bic",
        "incassoSoort",
    ];

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

    /**
     * @return array
     */
    public function getRelatiesoort(): array
    {
        return $this->relatiesoort;
    }

    /**
     * @param array $relatiesoort
     * @return Relatie
     */
    public function setRelatiesoort(array $relatiesoort): self
    {
        $this->relatiesoort = $relatiesoort;

        return $this;
    }

    /**
     * @return int
     */
    public function getRelatiecode(): ?int
    {
        return $this->relatiecode;
    }

    /**
     * @param int $relatiecode
     * @return Relatie
     */
    public function setRelatiecode(?int $relatiecode): self
    {
        $this->relatiecode = $relatiecode;

        return $this;
    }

    /**
     * @return string
     */
    public function getNaam(): string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    public function getVestigingsAdres(): Adres
    {
        return $this->vestigingsAdres ?? new Adres();
    }

    public function setVestigingsAdres(Adres $vestigingsAdres): self
    {
        $this->vestigingsAdres = $vestigingsAdres;

        return $this;
    }

    public function getCorrespondentieAdres(): Adres
    {
        return $this->correspondentieAdres ?? new Adres();
    }

    public function setCorrespondentieAdres(Adres $correspondentieAdres): self
    {
        $this->correspondentieAdres = $correspondentieAdres;

        return $this;
    }

    public function getTelefoon(): ?string
    {
        return $this->telefoon;
    }

    public function setTelefoon(?string $telefoon): self
    {
        $this->telefoon = $telefoon;

        return $this;
    }

    public function getMobieleTelefoon(): ?string
    {
        return $this->mobieleTelefoon;
    }

    public function setMobieleTelefoon(?string $mobieleTelefoon): self
    {
        $this->mobieleTelefoon = $mobieleTelefoon;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param null|string $email
     * @return Relatie
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getBtwNummer(): ?string
    {
        return $this->btwNummer;
    }

    /**
     * @param null|string $btwNummer
     * @return Relatie
     */
    public function setBtwNummer(?string $btwNummer): self
    {
        $this->btwNummer = $btwNummer;

        return $this;
    }

    /**
     * @return Money|null
     */
    public function getFactuurkorting(): ?Money
    {
        return $this->factuurkorting;
    }

    /**
     * @param Money|null $factuurkorting
     * @return Relatie
     */
    public function setFactuurkorting(?Money $factuurkorting): self
    {
        $this->factuurkorting = $factuurkorting;

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
     * @return Relatie
     */
    public function setKrediettermijn(?int $krediettermijn): self
    {
        $this->krediettermijn = $krediettermijn ?? $this->krediettermijn;

        return $this;
    }

    /**
     * @return bool
     */
    public function isBankieren(): bool
    {
        return $this->bankieren;
    }

    /**
     * @param bool $bankieren
     * @return Relatie
     */
    public function setBankieren(bool $bankieren): self
    {
        $this->bankieren = $bankieren;

        return $this;
    }

    /**
     * @return bool
     */
    public function isNonactief(): bool
    {
        return $this->nonactief;
    }

    /**
     * @param bool $nonactief
     * @return Relatie
     */
    public function setNonactief(bool $nonactief): self
    {
        $this->nonactief = $nonactief;

        return $this;
    }

    /**
     * @return Money|null
     */
    public function getKredietLimiet(): ?Money
    {
        return $this->kredietLimiet;
    }

    /**
     * @param Money|null $kredietLimiet
     * @return Relatie
     */
    public function setKredietLimiet(?Money $kredietLimiet): self
    {
        $this->kredietLimiet = $kredietLimiet;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getMemo(): ?string
    {
        return $this->memo;
    }

    /**
     * @param null|string $memo
     * @return Relatie
     */
    public function setMemo(?string $memo): self
    {
        $this->memo = $memo;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getKvkNummer(): ?string
    {
        return $this->kvkNummer;
    }

    /**
     * @param null|string $kvkNummer
     * @return Relatie
     */
    public function setKvkNummer(?string $kvkNummer): self
    {
        $this->kvkNummer = $kvkNummer;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getWebsiteUrl(): ?string
    {
        return $this->websiteUrl;
    }

    /**
     * @param null|string $websiteUrl
     * @return Relatie
     */
    public function setWebsiteUrl(?string $websiteUrl): self
    {
        $this->websiteUrl = $websiteUrl;

        return $this;
    }

    /**
     * @return null|Types\Aanmaningsoort
     */
    public function getAanmaningsoort(): ?Types\Aanmaningsoort
    {
        return $this->aanmaningsoort;
    }

    /**
     * @param null|Types\Aanmaningsoort $aanmaningsoort
     * @return Relatie
     */
    public function setAanmaningsoort(?Types\Aanmaningsoort $aanmaningsoort): self
    {
        $this->aanmaningsoort = $aanmaningsoort;

        return $this;
    }

    /**
     * @return EmailVersturen
     */
    public function getOfferteEmailVersturen(): EmailVersturen
    {
        return $this->offerteEmailVersturen ?? new EmailVersturen(false);
    }

    /**
     * @param EmailVersturen $offerteEmailVersturen
     * @return Relatie
     */
    public function setOfferteEmailVersturen(EmailVersturen $offerteEmailVersturen): self
    {
        $this->offerteEmailVersturen = $offerteEmailVersturen;

        return $this;
    }

    /**
     * @return EmailVersturen
     */
    public function getBevestigingsEmailVersturen(): EmailVersturen
    {
        return $this->bevestigingsEmailVersturen ?? new EmailVersturen(false);
    }

    /**
     * @param EmailVersturen $bevestigingsEmailVersturen
     * @return Relatie
     */
    public function setBevestigingsEmailVersturen(EmailVersturen $bevestigingsEmailVersturen): self
    {
        $this->bevestigingsEmailVersturen = $bevestigingsEmailVersturen;

        return $this;
    }

    /**
     * @return EmailVersturen
     */
    public function getFactuurEmailVersturen(): EmailVersturen
    {
        return $this->factuurEmailVersturen ?? new EmailVersturen(false);
    }

    /**
     * @param EmailVersturen $factuurEmailVersturen
     * @return Relatie
     */
    public function setFactuurEmailVersturen(EmailVersturen $factuurEmailVersturen): self
    {
        $this->factuurEmailVersturen = $factuurEmailVersturen;

        return $this;
    }

    /**
     * @return EmailVersturen
     */
    public function getAanmaningEmailVersturen(): EmailVersturen
    {
        return $this->aanmaningEmailVersturen ?? new EmailVersturen(false);
    }

    /**
     * @param EmailVersturen $aanmaningEmailVersturen
     * @return Relatie
     */
    public function setAanmaningEmailVersturen(EmailVersturen $aanmaningEmailVersturen): self
    {
        $this->aanmaningEmailVersturen = $aanmaningEmailVersturen;

        return $this;
    }

    /**
     * @return bool
     */
    public function isUblBestandAlsBijlage(): bool
    {
        return $this->ublBestandAlsBijlage;
    }

    /**
     * @param bool $ublBestandAlsBijlage
     * @return Relatie
     */
    public function setUblBestandAlsBijlage(bool $ublBestandAlsBijlage): self
    {
        $this->ublBestandAlsBijlage = $ublBestandAlsBijlage;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getIban(): ?string
    {
        return $this->iban;
    }

    /**
     * @param null|string $iban
     * @return Relatie
     */
    public function setIban(?string $iban): self
    {
        $this->iban = $iban;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getBic(): ?string
    {
        return $this->bic;
    }

    /**
     * @param null|string $bic
     * @return Relatie
     */
    public function setBic(?string $bic): self
    {
        $this->bic = $bic;

        return $this;
    }

    /**
     * @return null|Types\Incassosoort
     */
    public function getIncassoSoort(): ?Types\Incassosoort
    {
        return $this->incassoSoort;
    }

    /**
     * @param null|Types\Incassosoort $incassoSoort
     * @return Relatie
     */
    public function setIncassoSoort(?Types\Incassosoort $incassoSoort): self
    {
        $this->incassoSoort = $incassoSoort;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getInkoopBoekingenUri(): ?string
    {
        return $this->inkoopBoekingenUri;
    }

    /**
     * @param null|string $inkoopBoekingenUri
     * @return Relatie
     */
    public function setInkoopBoekingenUri(?string $inkoopBoekingenUri): self
    {
        $this->inkoopBoekingenUri = $inkoopBoekingenUri;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getVerkoopBoekingenUri(): ?string
    {
        return $this->verkoopBoekingenUri;
    }

    /**
     * @param null|string $verkoopBoekingenUri
     * @return Relatie
     */
    public function setVerkoopBoekingenUri(?string $verkoopBoekingenUri): self
    {
        $this->verkoopBoekingenUri = $verkoopBoekingenUri;

        return $this;
    }
}
