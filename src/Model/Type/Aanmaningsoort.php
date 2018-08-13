<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\Type;

use MyCLabs\Enum\Enum;

class Aanmaningsoort extends Enum
{
    private const NEE           =   'Nee';
    private const ONDERNEMING   =   'Onderneming';
    private const CONSUMENT     =   'Consument';
}