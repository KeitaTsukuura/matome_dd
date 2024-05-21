<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCommentColumnInCommentsTable extends Migration
{
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->renameColumn('comment', 'body');
        });
    }

    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->renameColumn('body', 'comment');
        });
    }
}
