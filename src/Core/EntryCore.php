<?php

namespace Ali3bdalla\XAccounting\Core;

use Ali3bdalla\XAccounting\Models\XAccountingEntry;
use Ali3bdalla\XAccounting\Traits\HasXAccountingTransactions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Tests\Laravel\App;
use Throwable;
use \Exception;

class EntryCore
{
    private $accounts;

    public function __construct()
    {
        $this->accounts = new Collection();
    }

    /**
     * @throws Throwable
     */
    public function create(array $data)
    {
        foreach ($data as $item) {
            $item = collect($item);
            $this->addAccount($item->get('account', null), $item->get('type'), $item->get('amount'));
        }
        $this->validateData();
        return $this->save();
    }

    /**
     * @throws Throwable
     */
    public function addAccount($account, $type, $amount = 0)
    {
        $this->validateType($type);
        $this->validateAmount($amount);
        $this->validateModel($account);
        $this->accounts->push([
            'account' => $account,
            'type' => $type,
            'amount' => parse_amount($amount)
        ]);
    }

    /**
     * @throws Throwable
     */
    private function validateType($type)
    {
        throw_if(!in_array($type, ['credit', 'debit']), new Exception('x-accounting invalid type: type should be credit or debit'));
    }

    /**
     * @throws Throwable
     */
    private function validateAmount($amount)
    {
        throw_if((float)$amount < 0, new Exception('x-accounting invalid type: type should be credit or debit'));
    }

    /**
     * @throws Throwable
     */
    private function validateModel($account)
    {
        is_valid_x_accounting_account($account);
    }

    /**
     * @throws Throwable
     */
    public function validateData()
    {
        $totalDebit = $this->accounts->where('type', 'debit')->sum('amount');
        $totalCredit = $this->accounts->where('type', 'credit')->sum('amount');
        throw_if($totalCredit !== $totalDebit, new Exception('x-accounting invalid amounts: debit amount should match credit amount'));

    }

    private function save()
    {
        return DB::transaction(function () {
            $entry = XAccountingEntry::create([
                'amount' => $this->getTotalAmount(),

            ]);
            foreach ($this->accounts as $account) {
                $account['account']->xAccountingTransactions()->create([
                    'entry_id' => $entry->id,
                    'amount' => $account['amount'],
                    'type' => $account['type'],
                ]);
            }
            return $entry->load('transactions.account');
        });
    }

    private function getTotalAmount()
    {
        return $this->accounts->where('type', 'debit')->sum('amount');
    }
}
