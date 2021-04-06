<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class XAccountingBalanceSnapshots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('x_accounting_balance_snapshots', function (Blueprint $table) {
            $table->id();
            $table->morphs('balancer');
            $table->decimal('credit', 50, 2)->default(0);
            $table->decimal('debit', 50, 2)->default(0);
            $table->date('date');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('x_accounting_balance_snapshots');
    }
}
