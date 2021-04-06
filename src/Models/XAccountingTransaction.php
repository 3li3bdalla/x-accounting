<?php

namespace Ali3bdalla\XAccounting\Models;

use Illuminate\Database\Eloquent\Model;

class XAccountingTransaction extends Model
{
    protected $table = 'x_accounting_transactions';
    protected $guarded = [];
    public function entry()
    {
        return $this->belongsTo(XAccountingEntry::class, 'entry_id');
    }

    public function account()
    {
        return $this->morphTo('account');
    }
}
