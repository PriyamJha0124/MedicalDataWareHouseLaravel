<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('vaccinations', function (Blueprint $table) {
            $table->id();
            $table->string('YearWeekISO')->nullable();
            $table->string('ReportingCountry')->nullable();
            $table->string('Denominator')->nullable();
            $table->string('NumberOfIndivOneDose')->nullable();
            $table->string('Region')->nullable();
            $table->string('TargetGroup')->nullable();
            $table->string('Vaccine')->nullable();
            $table->string('Population')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vaccinations');
    }
};
