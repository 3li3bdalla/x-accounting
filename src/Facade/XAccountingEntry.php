<?php


namespace Ali3bdalla\XAccounting\Facade;


use Illuminate\Support\Facades\Facade;

/**
 * @method static create(mixed|null $data, mixed|null $amount)
 */
class XAccountingEntry extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'x-accounting-entry';
    }
}
