<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use Rector\Config\RectorConfig;
use Rector\Core\Configuration\Option;
use Rector\Php74\Rector\Property\TypedPropertyRector;
use Rector\Set\ValueObject\SetList;
use Rector\Core\ValueObject\PhpVersion;

return static function (RectorConfig $rectorConfig): void {
    // get parameters
    $parameters = $rectorConfig->parameters();
    // get services (needed for register a single rule)
    $services = $rectorConfig->services();

    // Define what rule sets will be applied
    // $containerConfigurator->import(SetList::DEAD_CODE);
    $rectorConfig->import(SetList::CODE_QUALITY);
    $rectorConfig->import(SetList::PHP_74);

    // register a single rule
    $rectorConfig->ruleWithConfiguration(TypedPropertyRector::class, [
        TypedPropertyRector::INLINE_PUBLIC => true,
    ]);
};
