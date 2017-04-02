<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoleToUsersTableAndAliasToProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('role')->default(0)->after('password')->comment('Vai tro cua admin');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('alias')->nullable()->after('code')->comment('ten thay the');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table){
           $table->dropColumn('role');
        });

        Schema::table('products', function (Blueprint $table){
            $table->dropColumn('alias');
        });
    }
}
