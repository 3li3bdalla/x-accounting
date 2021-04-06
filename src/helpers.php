<?php


use Ali3bdalla\XAccounting\Core\EntryCore;
use Ali3bdalla\XAccounting\Facade\XAccountingEntry;
use Ali3bdalla\XAccounting\Traits\HasXAccountingTransactions;
use Illuminate\Database\Eloquent\Model;

if (!function_exists('create_x_accounting_entry')) {
    function create_x_accounting_entry($data = null)
    {
        return XAccountingEntry::create($data);
    }
}

if (!function_exists('parse_amount')) {
    function parse_amount($amount = 0)
    {
        return floatval(number_format(round($amount, 2), 2, '.', ''));
    }
}
if (!function_exists('is_valid_x_accounting_account')) {
    /**
     * @throws Throwable
     */
    function is_valid_x_accounting_account($account)
    {
        throw_if($account === null || !app(get_class($account)) instanceof Model || !in_array(HasXAccountingTransactions::class, class_uses_recursive($account)), new Exception('x-accounting invalid account: account  should use HasXAccountingTransactions trait'));

    }
}
if (!function_exists('class_uses_recursive')) {
    function class_uses_recursive($class)
    {
        if (is_object($class)) {
            $class = get_class($class);
        }

        $results = [];

        foreach (array_reverse(class_parents($class)) + [$class => $class] as $class) {
            $results += trait_uses_recursive($class);
        }

        return array_unique($results);
    }
}
if (!function_exists('trait_uses_recursive')) {
    function trait_uses_recursive($trait)
    {
        $traits = class_uses($trait);

        foreach ($traits as $trait) {
            $traits += trait_uses_recursive($trait);
        }

        return $traits;
    }
}


if (!function_exists('get_x_accounting_account_transactions')) {
    /**
     * @throws Throwable
     */
    function get_x_accounting_account_transactions($account)
    {
        is_valid_x_accounting_account($account);
        return $account->xAccountingTransactions()->with('entry')->paginate(50);
    }
}

if (!function_exists('get_x_accounting_account_transactions')) {
    /**
     * @throws Throwable
     */
    function get_x_accounting_account_transactions($account)
    {
        is_valid_x_accounting_account($account);
        return [
            'debit' => 0,
            'credit' => 0,
        ];
    }
}
