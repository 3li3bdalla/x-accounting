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




### create new entry using Facade 
```

```

