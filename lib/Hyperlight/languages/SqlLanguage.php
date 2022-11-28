<?php

namespace Hyperlight\languages;

use Hyperlight\HyperLanguage,
    Hyperlight\Rule;

class SqlLanguage extends HyperLanguage
{
    public function __construct ()
    {
        $this->setInfo (array
        (
            parent::NAME => 'Sql',
            parent::AUTHOR  => array
            (
                parent::NAME    => 'Raziel Anarki',
                parent::EMAIL => 'razielanarki@semmi.se'
            )
        ));

        $this->setExtensions (array ('ini'));

        $this->addStates (array
        (
            'init'    => array
            (
                'comment', 'string', 'char', 'number',
                'keyword' => array ('', 'type', 'literal', 'operator', 'builtin'),
                'identifier', 'variable'
            ),
            'keyword' => array ('', 'type', 'literal', 'operator', 'builtin'),
            'variable' => array ('identifier'),
        ));

        $this->addRules (array
        (
            'comment'    => '/--.*\n/',
            'string' => Rule::C_DOUBLEQUOTESTRING,
            'char' => Rule::C_SINGLEQUOTESTRING,
            'number' => Rule::C_NUMBER,
            'identifier' => Rule::C_IDENTIFIER,
            'variable' => new Rule('/`/', '/`/'),
            'keyword' => array
            (
                array
                (
                    'CREATE', 'ALTER', 'TABLE', 'PRIMARY KEY', 'SELECT', 'FROM', 'WHERE', 'ORDER BY',
                    'LIMIT', 'OFFSET', 'LEFT', 'RIGHT', 'OUTER', 'JOIN', 'GROUP BY',
                    'UPDATE', 'REPLACE', 'DELETE', 'SET', 'VALUES'
                ),
                'type' => array('INT', 'VARCHAR', 'TEXT'),
                'literal' => array('NOT NULL', 'NULL'),
                'operator' => array('AND', 'AS', 'OR', 'XOR', 'ON', 'IN', 'NOT', 'BETWEEN'),
                'builtin' => array('DATE', 'COUNT')
            ),
        ));

        $this->addMappings (array
        (
            'char' => 'string',
            'variable' => 'tag',
        ));
    }
}
