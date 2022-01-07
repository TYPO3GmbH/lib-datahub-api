<?php

if (PHP_SAPI !== 'cli') {
    die('This script supports command line usage only. Please check your command.');
}

$header = <<<EOF
This file is part of the package t3g/datahub-api-library.
For the full copyright and license information, please read the
LICENSE file that was distributed with this source code.
EOF;

return (new PhpCsFixer\Config())
    ->setCacheFile(__DIR__ . '/.php-cs-fixer.cache')
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR2' => true,
        'declare_strict_types' => true,
        'header_comment' => [
            'header' => $header,
        ],
        'general_phpdoc_annotation_remove' => [
            'annotations' => ['author']
        ],
        'no_leading_import_slash' => true,
        'no_trailing_comma_in_singleline_array' => true,
        'no_singleline_whitespace_before_semicolons' => true,
        'no_unused_imports' => true,
        'concat_space' => ['spacing' => 'one'],
        'no_whitespace_in_blank_line' => true,
        'ordered_imports' => true,
        'single_quote' => true,
        'no_empty_statement' => true,
        'no_extra_blank_lines' => true,
        'phpdoc_no_package' => true,
        'phpdoc_scalar' => true,
        'no_blank_lines_after_phpdoc' => true,
        'array_syntax' => ['syntax' => 'short'],
        'whitespace_after_comma_in_array' => true,
        'function_typehint_space' => true,
        'single_line_comment_style' => true,
        'no_alias_functions' => true,
        'lowercase_cast' => true,
        'no_leading_namespace_whitespace' => true,
        'native_function_casing' => true,
        'self_accessor' => true,
        'no_short_bool_cast' => true,
        'no_unneeded_control_parentheses' => true,
        'yoda_style' => [
            'equal' => true,
            'identical' => true,
            'less_and_greater' => true,
        ],
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in(['src', 'tests'])
    );
