<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__.'/src')
;

$config = new PhpCsFixer\Config();
return $config->setRules([
        '@PSR2' => true,
        '@Symfony' => true,
        'is_null' => true,
        'phpdoc_align' => false,
        'phpdoc_scalar' => false,
        'phpdoc_summary' => false,
        'no_alternative_syntax' => true,
        'phpdoc_line_span' => [
            'property' => 'single'
        ],
    ])
    ->setUsingCache(true)
    ->setFinder($finder)
;
