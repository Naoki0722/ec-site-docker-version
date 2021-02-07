<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeProductsTableColumnCategoryToCategoryId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // カラム名変更
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('category', 'category_id');
        });
        // カラム定義変更
        Schema::table('products', function (Blueprint $table) {
            $table->integer('category_id')->default(NULL)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // カラム定義戻す
        Schema::table('products', function (Blueprint $table) {
            $table->string('category_id')->change();
        });
        // カラム名を戻す
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('category_id', 'category');
        });
    }
}
