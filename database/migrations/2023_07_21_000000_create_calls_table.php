<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('calls', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->timestamp('time');
            $table->string('text');
            $table->boolean('is_completed')->default(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('calls');
    }
};
