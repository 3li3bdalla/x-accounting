# x-accounting

Laravel Accounting Package

## installation

add this to you composer.json file

```
   ...
   "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/ali3bdalla/x-accounting.git"
    }
  ],
  "require": {
    "ali3bdalla/x-accounting": "*"
  },
  ...
```

## usage

### prepare your accounting model

your accounting model should use `Ali3bdalla\XAccounting\Traits\HasXAccountingTransactions` trait

#### 1- App\Models\Invoice

```
   <?php
   namespace App\Models\Invoice;
   use Illuminate\Database\Eloquent\Model;
   use Ali3bdalla\XAccounting\Traits\HasXAccountingTransactions;
   class Invoice extends Model {
    ...
    use HasXAccountingTransactions;
    ...
   }
```

#### 2- App\Models\Tax

```
   <?php
   namespace App\Models\Invoice;
   use Illuminate\Database\Eloquent\Model;
   use Ali3bdalla\XAccounting\Traits\HasXAccountingTransactions;
   class Tax extends Model {
    ...
    use HasXAccountingTransactions;
    ...
   }
```

### create new accounting entry

using helper function `create_x_accounting_entry`

```
create_x_accounting_entry([
        [
            "type" => 'credit',
            "amount" => 550.53,
            'account' => Tax::find(1)
        ],
        [
            "type" => 'debit',
            "amount" => 550.53,
            'account' => Invoice::find(5)
        ]
    ])
```

### get account transactions

``` 
  get_x_accounting_account_transactions(Invoice::find(5))
```
