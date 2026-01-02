<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Whitespace\MethodChainingIndentationFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return ECSConfig::configure()
  ->withPaths([__DIR__ . "/site"])
  ->withSkip([
    __DIR__ . "/site/plugins",
    __DIR__ . "/site/config/vite.config.php",
    MethodChainingIndentationFixer::class,
  ])
  ->withPreparedSets(psr12: true, common: true, cleanCode: true)
  ->withParallel();
