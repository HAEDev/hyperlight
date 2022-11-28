<?php

namespace Hyperlight\languages;

use Hyperlight\HyperLanguage,
    Hyperlight\Rule;

class IniLanguage extends HyperLanguage
{
    public function __construct ()
    {
        $this->setInfo (array
        (
            parent::NAME => 'Ini',
            parent::AUTHOR  => array
            (
                parent::NAME    => 'Raziel Anarki',
                parent::EMAIL => 'razielanarki@semmi.se'
            )
        ));

        $this->setExtensions (array ('ini'));

        $this->addStates (array
        (
            'init'    => array ('comment', 'section', 'setting', 'value'),
            'section' => array ('name'),
            'setting' => array ('identifier', 'index'),
            'index'   => array ('key'),
            'value'   => array ('string')
        ));

        $this->addRules (array
        (
            'comment'    => '/;.*\n/',
            'section'    => new Rule ('/\[/', '/\]/'),
            'setting'    => new Rule ('/(?!\s*[;\[])/', '/(?==)/'),
            'identifier' => Rule::C_IDENTIFIER,
            'index'      => new Rule ('/\[/', '/\]/'),
            'value'      => new Rule ('/=/', '/\n/'),
            'key'        => '/[^\]]*/',
            'name'       => '/[^\]]*/',
            'string'     => '/.*/'
        ));

        $this->addMappings (array
        (
            'name'       => 'keyword',
            'identifier' => 'keyword builtin',
            'key'        => 'variable'
        ));
    }
}
