<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('user_stats')) {
            Schema::create('user_stats', function (Blueprint $table) {
                $table->integer('user_id')->unique();
                $table->date('created_at');
                $table->integer('onboarding_percentage')->nullable();
                $table->string('count_applications');
                $table->tinyInteger('count_accepted_applications')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_stats');
    }
}
