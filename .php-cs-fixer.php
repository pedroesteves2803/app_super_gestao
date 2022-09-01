<?php

# As pastas excluídas são de um projeto Laravel (Opcional)
$finder = PhpCsFixer\Finder::create()
    ->exclude([
        'storage',
        'vendor',
        'tools',
    ])->in(__DIR__);

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony'               => true,
        'binary_operator_spaces' => ['operators' => ['=>' => 'align_single_space_minimal']],
    ])->setFinder($finder);
