<?php declare(strict_types=1);

/**
 * @see https://www.tomasvotruba.cz/blog/2019/03/28/how-to-mock-final-classes-in-phpunit/
 */

use DG\BypassFinals;
use PHPUnit\Runner\BeforeTestHook;

final class BypassFinalHook implements BeforeTestHook
{
    public function executeBeforeTest(string $test): void
    {
        BypassFinals::enable();
    }
}