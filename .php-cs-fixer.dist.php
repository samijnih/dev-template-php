<?php

$finder = PhpCsFixer\Finder::create()
    ->in(
        [
            __DIR__.'/src',
            __DIR__.'/tests',
        ]
    );

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        '@PSR1' => true,
        '@PSR2' => true,
        '@PSR12:risky' => true,
        '@PHP81Migration' => true,
        '@PHPUnit84Migration:risky' => true,
        'array_push' => true,
        'array_syntax' => ['syntax' => 'short'],
        'no_unneeded_final_method' => true,
        'self_static_accessor' => true,
        'visibility_required' => true,
        'date_time_immutable' => true,
        'no_empty_comment' => true,
        'elseif' => true,
        'no_useless_else' => true,
        'self_accessor' => true,
        'align_multiline_comment' => ['comment_type' => 'phpdocs_only'],
        'binary_operator_spaces' => [
            'operators' => [
                '|' => 'no_space',
            ],
        ],
        'braces' => [
            'allow_single_line_closure' => true,
        ],
        'concat_space' => ['spacing' => 'none'],
        'class_attributes_separation' => ['elements' =>  ['method' => 'one']],
        'combine_consecutive_issets' => true,
        'combine_consecutive_unsets' => true,
        'compact_nullable_typehint' => true,
        'declare_strict_types' => true,
        'fully_qualified_strict_types' => true,
        'object_operator_without_whitespace' => true,
        'php_unit_construct' => true,
        'php_unit_dedicate_assert' => true,
        'php_unit_dedicate_assert_internal_type' => true,
        'php_unit_internal_class' => true,
        'no_useless_return' => true,
        'simplified_null_return' => true,
        'modernize_strpos' => true,
        'pow_to_exponentiation' => true,
        'no_mixed_echo_print' => true,
        'heredoc_indentation' => true,
        'heredoc_to_nowdoc' => true,
        'yoda_style' => true,
        'no_unused_imports' => true,
        'ordered_imports' => true,
        'assign_null_coalescing_to_coalesce_equal' => true,
        'method_argument_space' => ['keep_multiple_spaces_after_comma' => false],
        'list_syntax' => ['syntax' => 'short'],
        'void_return' => true,
        'whitespace_after_comma_in_array' => true,
        'function_typehint_space' => true,
    ])
    ->setFinder($finder)
    ->setCacheFile('.php-cs-fixer.cache')
;
