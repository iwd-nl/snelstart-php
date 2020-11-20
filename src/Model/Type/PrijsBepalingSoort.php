<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\Type;

use MyCLabs\Enum\Enum;

/**
 * @psalm-immutable
 *
 * @method static PrijsBepalingSoort NORMALEVERKOOPPRIJS()
 * @method static PrijsBepalingSoort ACTIEPRIJZENPERARTIKEL()
 * @method static PrijsBepalingSoort ACTIEPRIJZENPERARTIKELKORTINGSGROEP()
 * @method static PrijsBepalingSoort AFSPRAAKPERARTIKELKLANT()
 * @method static PrijsBepalingSoort AFSPRAAKPERARTIKELPERKLANTKORTINGSGROEP()
 * @method static PrijsBepalingSoort AFSPRAAKPERKLANTPERARTIKELKORTINGSGROEP()
 * @method static PrijsBepalingSoort AFSPRAAKPERARTIKELKORTINGSGROEPPERKLANTKORTINGSGROEP()
 */
final class PrijsBepalingSoort extends Enum
{
    private const NORMALEVERKOOPPRIJS                                   = 'NormaleVerkoopprijs';
    private const ACTIEPRIJZENPERARTIKEL                                = 'ActieprijzenPerArtikel';
    private const ACTIEPRIJZENPERARTIKELKORTINGSGROEP                   = 'ActieprijzenPerArtikelkortingsgroep';
    private const AFSPRAAKPERARTIKELKLANT                               = 'AfspraakPerArtikelklant';
    private const AFSPRAAKPERARTIKELPERKLANTKORTINGSGROEP               = 'AfspraakPerArtikelPerKlantkortingsgroep';
    private const AFSPRAAKPERKLANTPERARTIKELKORTINGSGROEP               = 'AfspraakPerKlantPerArtikelkortingsgroep';
    private const AFSPRAAKPERARTIKELKORTINGSGROEPPERKLANTKORTINGSGROEP  = 'AfspraakPerArtikelkortingsgroepPerKlantkortingsgroep';
}