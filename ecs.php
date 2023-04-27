<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use PhpCsFixer\Fixer\CastNotation\CastSpacesFixer;
use PhpCsFixer\Fixer\Import\OrderedImportsFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use PhpCsFixer\Fixer\Operator\NotOperatorWithSuccessorSpaceFixer;
use PhpCsFixer\Fixer\Whitespace\BlankLineBeforeStatementFixer;
use PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer;
use Symplify\CodingStandard\Fixer\LineLength\LineLengthFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ECSConfig $ecsConfig): void {
    $ecsConfig->parallel();
    $ecsConfig->cacheDirectory(__DIR__ . '/var/cache/ecs');
    $ecsConfig->paths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    #region setup list rules
    $ecsConfig->sets(
        [
            SetList::DOCBLOCK,
            SetList::PSR_12,
            SetList::SPACES,
            SetList::ARRAY,
            SetList::CLEAN_CODE,
            SetList::STRICT,
        ]
    );

    #endregion setup list rules

    #region setup standalone rules

    $ecsConfig->rule(ArraySyntaxFixer::class);
    $ecsConfig->rule(OrderedImportsFixer::class);

    #endregion setup standalone rules

    #region setup standalone rules with cfg

    $ecsConfig->ruleWithConfiguration(LineLengthFixer::class, [
        LineLengthFixer::LINE_LENGTH => 120,
        LineLengthFixer::BREAK_LONG_LINES => true,
        LineLengthFixer::INLINE_SHORT_LINES => false,
    ]);

    $ecsConfig->ruleWithConfiguration(ConcatSpaceFixer::class, [
        'spacing' => 'one',
    ]);
    $ecsConfig->ruleWithConfiguration(CastSpacesFixer::class, [
        'space' => 'single',
    ]);
    $ecsConfig->ruleWithConfiguration(
        BlankLineBeforeStatementFixer::class,
        [
            'statements' => [
                'for',
                'foreach',
                'if',
                'switch',
                'while',
                'try',
                'return',
                'declare',
            ],
        ]
    );

    $ecsConfig->ruleWithConfiguration(NoExtraBlankLinesFixer::class, [
        'tokens' => [
            'break', 'case', 'continue', 'curly_brace_block',
            'default', 'extra', 'parenthesis_brace_block', 'return',
            'square_brace_block', 'switch', 'throw',
        ],
    ]);

    #endregion setup standalone rules with cfg

    $ecsConfig->skip([NotOperatorWithSuccessorSpaceFixer::class]);
};
