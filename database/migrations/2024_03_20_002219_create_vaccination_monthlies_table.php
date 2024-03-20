<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('vaccination_monthlies', function (Blueprint $table) {
            $table->id();
            $table->string('');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vaccination_monthlies');
    }
};
