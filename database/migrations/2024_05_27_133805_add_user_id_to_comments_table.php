<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $defaultUserId = User::first()->id ?? null;

        // ステップ1: すでに user_id カラムが存在しない場合にのみ追加
        if (!Schema::hasColumn('comments', 'user_id')) {
            Schema::table('comments', function (Blueprint $table) use ($defaultUserId) {
                $table->unsignedBigInteger('user_id')->default($defaultUserId)->after('id');
            });
        }

        // ステップ2: 既存の投稿をデフォルトの user_id に更新
        DB::table('comments')->update(['user_id' => $defaultUserId]);

        // ステップ3: user_id カラムを null 不可にし、外部キー制約を追加
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            //
        });
    }
};
