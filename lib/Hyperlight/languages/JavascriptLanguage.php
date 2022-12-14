<?php

namespace Hyperlight\languages;

use Hyperlight\HyperLanguage,
    Hyperlight\Rule;

/* For licensing and copyright terms, see the file named LICENSE */

class JavascriptLanguage extends HyperLanguage
{
    public function __construct ()
    {
        $this->setInfo (array
        (
            parent::NAME => 'Javascript',
        ));

        $this->setExtensions (array ('js', 'json'));
        $this->setCaseInsensitive (false);
        $this->addStates (array
        (
            'init' => array
            (
                'string',
                'char',
                'number',
                'comment',
                'keyword' => array('', 'literal', 'operator'),
                'identifier',
                'tag'
            ),
        ));

        $this->addRules (array
        (
            'string'  => Rule::C_DOUBLEQUOTESTRING,
            'char'    => Rule::C_SINGLEQUOTESTRING,
            'number'  => Rule::C_NUMBER,
            'comment' => Rule::C_COMMENT,
            'keyword' => array
            (
                array
                (
                    'assert', 'break', 'class', 'continue',
                    'else', 'except', 'finally', 'for',
                    'if', 'in', 'function', 'var',
                    'throw', 'return', 'try', 'while', 'with', 'typeof'
                ),
                'literal'  => array ('false', 'null', 'true', 'undefined'),
                'operator' => '/[-+*\/%&|^!~=<>?{}()\[\].,:;]|&&|\|\||<<|>>|[-=!<>+*\/%&|^]=|<<=|>>=|->/',
            ),
            'identifier' => Rule::C_IDENTIFIER,
            'tag'        => '/\$/',
        ));

        $this->addMappings(array
        (
            'char'             => 'string',
            'keyword operator' => '',
        ));
    }
}
