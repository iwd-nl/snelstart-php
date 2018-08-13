<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 */

namespace SnelstartPHP\Model\Type;

use MyCLabs\Enum\Enum;

class Grootboekfunctie extends Enum
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