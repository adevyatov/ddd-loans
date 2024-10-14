<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->name('*.php');

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,
        'phpdoc_trim' => true,
        'no_empty_phpdoc' => true,
        'phpdoc_no_empty_return' => true,
        'no_superfluous_phpdoc_tags' => true,
    ])
    ->setFinder($finder);
