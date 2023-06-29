<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Php74\Rector\Assign\NullCoalescingOperatorRector;
use Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector;
use Rector\Php80\Rector\Catch_\RemoveUnusedVariableInCatchRector;
use Rector\Php80\Rector\Class_\ClassPropertyAssignToConstructorPromotionRector;
use Rector\Php80\Rector\Class_\StringableForToStringRector;
use Rector\Php80\Rector\FuncCall\ClassOnObjectRector;
use Rector\Php80\Rector\FunctionLike\MixedTypeRector;
use Rector\Php80\Rector\Identical\StrEndsWithRector;
use Rector\Php80\Rector\NotIdentical\StrContainsRector;
use Rector\Php81\Rector\Class_\MyCLabsClassToEnumRector;
use Rector\Php81\Rector\FuncCall\NullToStrictStringFuncCallArgRector;
use Rector\Php81\Rector\MethodCall\MyCLabsMethodCallToEnumConstRector;
use Rector\Php81\Rector\Property\ReadOnlyPropertyRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnNeverTypeRector;
use Rector\TypeDeclaration\Rector\Property\TypedPropertyFromAssignsRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    // register a single rule
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);

    // define sets of rules
    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_81,
    ]);

    $rectorConfig->skip([
        // PHP 7.4
        TypedPropertyFromAssignsRector::class,
        NullCoalescingOperatorRector::class, // https://wiki.php.net/rfc/null_coalesce_equal_operator
        ClosureToArrowFunctionRector::class, // https://wiki.php.net/rfc/arrow_functions_v2
        // PHP 8.1
        MixedTypeRector::class,
        ClassPropertyAssignToConstructorPromotionRector::class, // https://wiki.php.net/rfc/constructor_promotion https://github.com/php/php-src/pull/5291
        ClassOnObjectRector::class, // https://wiki.php.net/rfc/class_name_literal_on_object
        NullToStrictStringFuncCallArgRector::class,
        ReturnNeverTypeRector::class, // https://wiki.php.net/rfc/noreturn_type
        RemoveUnusedVariableInCatchRector::class, // https://wiki.php.net/rfc/non-capturing_catches
        StrEndsWithRector::class, // https://wiki.php.net/rfc/add_str_starts_with_and_ends_with_functions
        StrContainsRector::class, // https://externals.io/message/108562 https://github.com/php/php-src/pull/5179
        MyCLabsMethodCallToEnumConstRector::class, // https://wiki.php.net/rfc/enumerations
        MyCLabsClassToEnumRector::class, // https://wiki.php.net/rfc/enumerations
        StringableForToStringRector::class, // https://wiki.php.net/rfc/stringable
        ReadOnlyPropertyRector::class, // https://wiki.php.net/rfc/readonly_properties_v2
    ]);
};
