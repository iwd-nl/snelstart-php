<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

use Money\Money;
use SnelstartPHP\Model\Type as Types;

/**
 * @todo Support for the property 'factuurRelatie'
 */
class Relatie extends SnelstartObject
{
    /**
     * Datum waarop de gegevens van deze relatie zijn aangepast
     *
     * r@var \DateTimeInterface|null
     */
    private $modifiedOn;

    /**
     * @see Types\Relatiesoort
     * @var array[Types\Relatiesoort]
     */
    private $relatiesoort;

    /**
     * Het relatienummer
     *
     * @var int
     */
    private $relatiecode;

    /**
     * De volledige naam van de relatie.
     *
     * @var string
     */
    private $naam;

    /**
     * @var RelatieVestigingsAdres
     */
    private $vestigingsAdres;

    /**
     * @var RelatieCorrespondentieAdres
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
    private $aanmingsoort;

    /**
     * De emailgegevens voor het versturen van offertes.
     *
     * @var EmailVersturen
     */
    private $offerteEmailVersturen;

    /**
     * De emailgegevens voor het versturen van bevestigingen.
     *
     * @var EmailVersturen
     */
    private $bevestigingsEmailVersturen;

    /**
     * De emailgegevens voor het versturen van facturen.
     *
     * @var EmailVersturen
     */
    private $factuurEmailVersturen;

    /**
     * De emailgegevens voor het versturen van aanmaningen.
     *
     * @var EmailVersturen
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
     * @var string|null
     */
    private $inkoopBoekingenUri;

    /**
     * @var string|null
     */
    private $verkoopBoekingenUri;
}
