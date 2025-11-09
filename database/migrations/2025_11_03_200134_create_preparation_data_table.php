<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up(): void
{
    Schema::create('preparation_data', function (Blueprint $table) {
        $table->id();
        $table->foreignId('station_id')->constrained()->onDelete('cascade');
        $table->foreignId('object_category_id')->constrained()->onDelete('cascade');
        $table->date('report_date');
        $table->integer('plan_value')->default(0);
        $table->integer('fact_value')->default(0);
        $table->timestamps();
        
        $table->unique(['station_id', 'object_category_id', 'report_date'], 'station_object_date_unique');
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preparation_data');
    }
};
