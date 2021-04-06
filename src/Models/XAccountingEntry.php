<?php

namespace Ali3bdalla\XAccounting\Models;

use Illuminate\Database\Eloquent\Model;

class XAccountingEntry extends Model
{
    protected $table = 'x_accounting_entries';
    protected $guarded = [];
    public function transactions()
    {
        return $this->hasMany(XAccountingTransaction::class, 'entry_id');
    }
}
