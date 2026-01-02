<?php

declare(strict_types=1);

use Symplify\EasyCodingStandard\Config\ECSConfig;

return ECSConfig::configure()
    ->withPaths([
        __DIR__ . '/site',
    ])
    ->withSkip([
        __DIR__ . '/site/plugins',
    ])
    ->withPreparedSets(
        psr12: true,
        common: true,
        cleanCode: true,
    )
    ->withParallel();
