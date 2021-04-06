<?php

namespace Ali3bdalla\XAccounting\Traits;

use Ali3bdalla\XAccounting\Models\XAccountingTransaction;

trait HasXAccountingTransactions
{
    public function xAccountingTransactions()
    {
        return $this->morphMany(XAccountingTransaction::class, 'account');
    }
}
