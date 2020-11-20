<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 */

namespace SnelstartPHP\Model\Type;

use MyCLabs\Enum\Enum;

/**
 * @psalm-immutable
 *
 * @method static Grootboekfunctie DIVERSEN()
 * @method static Grootboekfunctie DAGBOEKKAS()
 * @method static Grootboekfunctie DAGBOEKBANK()
 * @method static Grootboekfunctie DAGBOEKGIRO()
 * @method static Grootboekfunctie DAGBOEKVERKOOP()
 * @method static Grootboekfunctie DAGBOEKINKOOP()
 * @method static Grootboekfunctie DAGBOEKMEMORIAAL()
 * @method static Grootboekfunctie DAGBOEKBALANS()
 * @method static Grootboekfunctie VERKOPENOMZETONBELASTVERLEGD()
 * @method static Grootboekfunctie VERKOPENOMZETLAAG()
 * @method static Grootboekfunctie VERKOPENOMZETHOOG()
 * @method static Grootboekfunctie VERKOPENOMZETOVERIG()
 * @method static Grootboekfunctie VERKOPENBTWVRIJ()
 * @method static Grootboekfunctie BTWAFTEDRAGENLAAG()
 * @method static Grootboekfunctie BTWAFTEDRAGENHOOG()
 * @method static Grootboekfunctie BTWAFTEDRAGENOVERIG()
 * @method static Grootboekfunctie BTWAFTEDRAGENVERLEGDVERKOPEN()
 * @method static Grootboekfunctie BTWTEVORDERENVERLEGD()
 * @method static Grootboekfunctie BTWAFTEDRAGENLAAGGLOBALISATIE()
 * @method static Grootboekfunctie BTWAFTEDRAGENHOOGGLOBALISATIE()
 * @method static Grootboekfunctie BTWAFTEDRAGENOVERIGGLOBALISATIE()
 * @method static Grootboekfunctie INKOPENKOSTENALLEBTWTARIEVEN()
 * @method static Grootboekfunctie INKOPENKOSTENLAAG()
 * @method static Grootboekfunctie INKOPENKOSTENHOOG()
 * @method static Grootboekfunctie INKOPENKOSTENOVERIG()
 * @method static Grootboekfunctie INKOPENVRAAGPOSTEN()
 * @method static Grootboekfunctie BTWTEVORDERENLAAG()
 * @method static Grootboekfunctie BTWTEVORDERENHOOG()
 * @method static Grootboekfunctie BTWTEVORDERENOVERIG()
 * @method static Grootboekfunctie BTWAFTEDRAGENVERLEGDINKOPEN()
 * @method static Grootboekfunctie BTWTEVORDERENVERLEGDINKOPEN()
 * @method static Grootboekfunctie INKOPENIMPORTBINNENEULAAG()
 * @method static Grootboekfunctie INKOPENIMPORTBINNENEUHOOG()
 * @method static Grootboekfunctie INKOPENIMPORTBINNENEUOVERIG()
 * @method static Grootboekfunctie INKOPENIMPORTBUITENEULAAG()
 * @method static Grootboekfunctie INKOPENIMPORTBUITENEUHOOG()
 * @method static Grootboekfunctie INKOPENIMPORTBUITENEUOVERIG()
 * @method static Grootboekfunctie VERKOPENEXPORTBINNENEU()
 * @method static Grootboekfunctie VERKOPENEXPORTBUITENEU()
 * @method static Grootboekfunctie ONINBAREVORDERINGEN()
 * @method static Grootboekfunctie HERREKENINGCORRECTIES()
 * @method static Grootboekfunctie INSTALLATIETELEVERKOOPBINNENEUGEEN()
 * @method static Grootboekfunctie BPMVERKOPEN()
 * @method static Grootboekfunctie BPMINKOPEN()
 * @method static Grootboekfunctie BPMVOORRAAD()
 * @method static Grootboekfunctie DIENSTVERLENINGBINNENEU()
 * @method static Grootboekfunctie VERKOOPGLOBALISATIELAAG()
 * @method static Grootboekfunctie VERKOOPGLOBALISATIEHOOG()
 * @method static Grootboekfunctie VERKOOPGLOBALISATIEOVERIG()
 * @method static Grootboekfunctie INKOOPGLOBALISATIELAAG()
 * @method static Grootboekfunctie INKOOPGLOBALISATIEHOOG()
 * @method static Grootboekfunctie BTWGLOBALISATIE()
 * @method static Grootboekfunctie KREDIETBEPERKINGVERKOPEN()
 * @method static Grootboekfunctie KREDIETBEPERKINGINKOPEN()
 * @method static Grootboekfunctie BETALINGSKORTING()
 * @method static Grootboekfunctie TUSSENREKENINGBETALINGEN()
 * @method static Grootboekfunctie ONBEKENDEBETALINGEN()
 * @method static Grootboekfunctie KRUISPOSTEN()
 * @method static Grootboekfunctie CONTANTEBETALING()
 * @method static Grootboekfunctie ELECTRONISCHEBETALING()
 * @method static Grootboekfunctie WINSTBOEKING()
 */
final class Grootboekfunctie extends Enum
{
    private const DIVERSEN                              = 'Diversen';
    private const DAGBOEKKAS                            = 'DagboekKas';
    private const DAGBOEKBANK                           = 'DagboekBank';
    private const DAGBOEKGIRO                           = 'DagboekGiro';
    private const DAGBOEKVERKOOP                        = 'DagboekVerkoop';
    private const DAGBOEKINKOOP                         = 'DagboekInkoop';
    private const DAGBOEKMEMORIAAL                      = 'DagboekMemoriaal';
    private const DAGBOEKBALANS                         = 'DagboekBalans';
    private const VERKOPENOMZETONBELASTVERLEGD          = 'VerkopenOmzetOnbelastVerlegd';
    private const VERKOPENOMZETLAAG                     = 'VerkopenOmzetLaag';
    private const VERKOPENOMZETHOOG                     = 'VerkopenOmzetHoog';
    private const VERKOPENOMZETOVERIG                   = 'VerkopenOmzetOverig';
    private const VERKOPENBTWVRIJ                       = 'VerkopenBtwVrij';
    private const BTWAFTEDRAGENLAAG                     = 'BtwAfteDragenLaag';
    private const BTWAFTEDRAGENHOOG                     = 'BtwAfTeDragenHoog';
    private const BTWAFTEDRAGENOVERIG                   = 'BtwAfTeDragenOverig';
    private const BTWAFTEDRAGENVERLEGDVERKOPEN          = 'BtwAfTeDragenVerlegdVerkopen';
    private const BTWTEVORDERENVERLEGD                  = 'BtwTeVorderenVerlegd';
    private const BTWAFTEDRAGENLAAGGLOBALISATIE         = 'BtwAfteDragenLaagGlobalisatie';
    private const BTWAFTEDRAGENHOOGGLOBALISATIE         = 'BtwAfTeDragenHoogGlobalisatie';
    private const BTWAFTEDRAGENOVERIGGLOBALISATIE       = 'BtwAfTeDragenOverigGlobalisatie';
    private const INKOPENKOSTENALLEBTWTARIEVEN          = 'InkopenKostenAlleBtwTarieven';
    private const INKOPENKOSTENLAAG                     = 'InkopenKostenLaag';
    private const INKOPENKOSTENHOOG                     = 'InkopenKostenHoog';
    private const INKOPENKOSTENOVERIG                   = 'InkopenKostenOverig';
    private const INKOPENVRAAGPOSTEN                    = 'InkopenVraagPosten';
    private const BTWTEVORDERENLAAG                     = 'BtwTeVorderenLaag';
    private const BTWTEVORDERENHOOG                     = 'BtwTeVorderenHoog';
    private const BTWTEVORDERENOVERIG                   = 'BtwTeVorderenOverig';
    private const BTWAFTEDRAGENVERLEGDINKOPEN           = 'BtwAfTeDragenVerlegdInkopen';
    private const BTWTEVORDERENVERLEGDINKOPEN           = 'BtwTeVorderenVerlegdInkopen';
    private const INKOPENIMPORTBINNENEULAAG             = 'InkopenImportBinnenEUlaag';
    private const INKOPENIMPORTBINNENEUHOOG             = 'InkopenImportBinnenEUhoog';
    private const INKOPENIMPORTBINNENEUOVERIG           = 'InkopenImportBinnenEUoverig';
    private const INKOPENIMPORTBUITENEULAAG             = 'InkopenImportBuitenEUlaag';
    private const INKOPENIMPORTBUITENEUHOOG             = 'InkopenImportBuitenEUhoog';
    private const INKOPENIMPORTBUITENEUOVERIG           = 'InkopenImportBuitenEUoverig';
    private const VERKOPENEXPORTBINNENEU                = 'VerkopenExportBinnenEU';
    private const VERKOPENEXPORTBUITENEU                = 'VerkopenExportBuitenEU';
    private const ONINBAREVORDERINGEN                   = 'OninbareVorderingen';
    private const HERREKENINGCORRECTIES                 = 'HerrekeningCorrecties';
    private const INSTALLATIETELEVERKOOPBINNENEUGEEN    = 'InstallatieTeleverkoopBinnenEUgeen';
    private const BPMVERKOPEN                           = 'BpmVerkopen';
    private const BPMINKOPEN                            = 'BpmInkopen';
    private const BPMVOORRAAD                           = 'BpmVoorraad';
    private const DIENSTVERLENINGBINNENEU               = 'DienstverleningBinnenEU';
    private const VERKOOPGLOBALISATIELAAG               = 'VerkoopGlobalisatieLaag';
    private const VERKOOPGLOBALISATIEHOOG               = 'VerkoopGlobalisatieHoog';
    private const VERKOOPGLOBALISATIEOVERIG             = 'VerkoopGlobalisatieOverig';
    private const INKOOPGLOBALISATIELAAG                = 'InkoopGlobalisatieLaag';
    private const INKOOPGLOBALISATIEHOOG                = 'InkoopGlobalisatieHoog';
    private const INKOOPGLOBALISATIEOVERIG              = 'InkoopGlobalisatieOverig';
    private const BTWGLOBALISATIE                       = 'BtwGlobalisatie';
    private const KREDIETBEPERKINGVERKOPEN              = 'KredietbeperkingVerkopen';
    private const KREDIETBEPERKINGINKOPEN               = 'KredietbeperkingInkopen';
    private const BETALINGSKORTING                      = 'Betalingskorting';
    private const TUSSENREKENINGBETALINGEN              = 'TussenrekeningBetalingen';
    private const ONBEKENDEBETALINGEN                   = 'OnbekendeBetalingen';
    private const KRUISPOSTEN                           = 'Kruisposten';
    private const CONTANTEBETALING                      = 'ContanteBetaling';
    private const ELECTRONISCHEBETALING                 = 'ElectronischeBetaling';
    private const WINSTBOEKING                          = 'Winstboeking';
}