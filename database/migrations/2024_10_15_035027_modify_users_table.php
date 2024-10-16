<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->renameColumn('name', 'username'); // Rename the 'name' column to 'username'
        $table->string('fullname')->after('username')->default('John Doe'); // Add a new 'fullname' column with default value 'John Doe'
        $table->string('address')->after('fullname')->default('Seven Street'); // Add a new 'address' column with default value 'Seven Street'
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('address'); // Drop the 'address' column
        $table->dropColumn('fullname'); // Drop the 'fullname' column
        $table->renameColumn('username', 'name'); // Rename the 'username' column back to 'name'
    });
}
};
