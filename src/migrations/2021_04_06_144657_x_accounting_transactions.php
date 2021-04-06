<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class XAccountingTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('x_accounting_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entry_id')->references('id')->on('x_accounting_entries');
            $table->morphs('account');
            $table->enum('type', ['debit', 'credit']);
            $table->decimal('amount', 50, 2)->default(0);
            $table->unsignedBigInteger('created_by_id')->nullable();
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
        Schema::dropIfExists('x_accounting_transactions');
    }
}
