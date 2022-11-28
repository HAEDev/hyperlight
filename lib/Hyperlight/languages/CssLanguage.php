<?php

namespace Hyperlight\languages;

use Hyperlight\HyperLanguage,
    Hyperlight\Rule;

class CssLanguage extends HyperLanguage
{
    public function __construct()
    {
        $this->setInfo(array
        (
            parent::NAME => 'CSS+LESS',
            parent::VERSION => '0.8',
            parent::AUTHOR => array
            (
                parent::NAME => 'Konrad Rudolph & Raziel Anarki',
                parent::WEBSITE => 'madrat.net',
                parent::EMAIL => 'konrad_rudolph@madrat.net, razielanarki@semmi.se'
            )
        ));

        $this->setExtensions (array ('css'));

        // The following does not conform to the specs but it is necessary
        // else numbers wouldn't be recognized any more.
        $nmstart = '-?[a-zA-Z_]';
        $nmchar = '[a-zA-Z0-9-_]';
        $hex = '[0-9a-f]';
        list ($string, $strmod) = preg_strip (Rule::STRING);
        $strmod = implode ('', $strmod);

        $this->addStates (array
        (
            'init' => array('comment', 'uri', 'meta', 'id', 'class', 'pseudoclass', 'element', 'block', 'constraint', 'string', 'paren'),
            'block' => array('comment', 'attribute', 'value', 'id', 'class', 'pseudoclass', 'element', 'block', 'string', 'meta', 'paren'),
            'constraint' => array ('identifier', 'string'),
            'paren' => array ('meta', 'color', 'number', 'identifier', 'attribute', 'paren', 'string'),
            'value' => array('comment', 'string', 'color', 'number', 'uri', 'identifier', 'important', 'meta', 'paren'),
        ));

        $this->addRules (array
        (
            'attribute' => "/$nmstart$nmchar*/i",
            'value' => new Rule('/:/', '/;|(?=\})/'),
            'comment' => Rule::C_COMMENT,
            'meta' => "/@$nmstart$nmchar*/i",
            'id' => "/#$nmstart$nmchar*/i",
            'class' => "/\.$nmstart$nmchar*/",
            // Pay attention not to match rules such as ::selection!
            'pseudoclass' => "/(?<!:):$nmstart$nmchar*/",
            'element' => "/$nmstart$nmchar*/i",
            'block' => new Rule('/\{/', '/\}/'),
            'constraint' => new Rule('/\[/', '/\]/'),
            'paren' => new Rule('/\(/', '/\)/'),
            'number' => '/[+-]?(?:\d+(\.\d+)?|\d*\.\d+)(%|em|ex|px|pt|in|cm|mm|pc|deg|g?rad|m?s|k?Hz)?/',
            'uri' => "/url\(\s*(?:$string|[^\)]*)\s*\)/$strmod",
            'identifier' => "/$nmstart$nmchar*/i",
            'variable' => "/@$nmstart$nmchar*/i",
            'string' => "/$string/$strmod",
            'color' => "/#$hex{3}(?:$hex{3})?/i",
            'important' => '/!\s*important/',
        ));

        $this->addMappings (array
        (
            'element' => 'keyword',
            'id' => 'keyword type',
            'class' => 'identifier',
            'important' => 'keyword type',
            'pseudoclass' => 'preprocessor',
            'block' => '',
            'constraint' => '',
            'paren' => '',
            'value' => '',
            'color' => 'string',
            'uri' => 'char',
            'meta' => 'tag',
            'variable' => 'tag',
        ));
    }
}
