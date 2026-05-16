<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // first_name and last_name already exist in the base users migration.
    }

    public function down()
    {
        // No-op duplicate migration.
    }
};
