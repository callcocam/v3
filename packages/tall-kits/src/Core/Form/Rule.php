<?php


namespace App\SIGA\Form;


use Illuminate\Validation\Rule as RuleAlias;

class Rule extends RuleAlias
{

    public static function unique($table, $column = 'NULL')
    {
        return parent::unique($table, $column);
    }
}
