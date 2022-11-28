<?php

namespace Hyperlight\languages;

use Hyperlight\HyperLanguage,
    Hyperlight\Rule;

class TwigLanguage extends HyperLanguage
{
    public function __construct ()
    {
        $this->setInfo (array
        (
            parent::NAME => 'Twig',
            parent::AUTHOR  => array
            (
                parent::NAME    => 'Raziel Anarki',
                parent::EMAIL => 'razielanarki@semmi.se'
            )
        ));

        $this->setExtensions (array ('twig'));

        $this->addStates (array
        (
            'init' => array ('html', 'twig', 'comment'),
            'twig' => array
            (
                'string', 'char', 'number',
                'keyword' => array ('', 'type', 'literal', 'operator', 'builtin'),
                'identifier'
            ),
            'comment' => array (),
            'html' => array ()
        ));

        $this->addRules (array
        (
            'html' => new Rule('/(?=.)/', '/(?={{|{%|{#)/'),
            'comment' => new Rule ('/{#/', '/#}/'),
            'twig' => new Rule('/{{|{%/', '/}}|%}/'),
            'string' => Rule::C_DOUBLEQUOTESTRING,
            'char' => Rule::C_SINGLEQUOTESTRING,
            'number' => Rule::C_NUMBER,
            'identifier' => Rule::C_IDENTIFIER,
            'keyword' => array
            (
                array
                (
                    'autoescape', 'block', 'do', 'embed', 'extends', 'filter', 'flush',
                    'for', 'from', 'if', 'import', 'include', 'macro', 'sandbox', 'set',
                    'spaceless', 'use', 'verbatim',
                    // --
                    'endautoescape', 'endblock',  'endembed', 'endfilter',
                    'endfor', 'endif', 'else', 'elseif', 'with', 'only', 'endmacro',
                    'endsandbox', 'endset', 'endspaceless', 'endverbatim'
                ),
                'type' => array
                (
                    'abs', 'batch', 'capizalize', 'convert_encoding', 'date', 'date_modify',
                    'default', 'escape', 'first', 'format', 'join', 'json_encode', 'keys',
                    'last', 'length', 'lower', 'merge', 'nl2br', 'number_format', 'raw',
                    'replace', 'reverse', 'slice', 'split', 'striptags', 'title', 'trim',
                    'upper', 'url_encode'
                ),
                'literal' => array
                (
                    'constant', 'defined', 'divisibleby', 'empty', 'even', 'iterable', 'null', 'odd',
                    'sameas'
                ),
                'operator' => array ('is', 'in', 'and', 'or', 'not', 'b-and', 'b-or', 'b-xor'),
                'builtin' => array
                (
                    'attribute', 'block', 'constant', 'cycle', 'date', 'dump', 'include', 'parent',
                    'random', 'range', 'template_from_string'
                )
            )
        ));

        $this->addMappings(array
        (
            'char' => 'string',
            'html' => 'preprocessor'
        ));
    }
}
