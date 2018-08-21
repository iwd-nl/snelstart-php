<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP;

final class Snelstart
{
    // Example: 2018-08-07T06:24:48.12
    public const DATETIME_FORMAT = "Y-m-d\TH:i:s.u";

    // Maximum results that will be returned on GET operations
    public const MAX_RESULTS = 500;

    // Only supports EUR
    public const CURRENCY = 'EUR';
}