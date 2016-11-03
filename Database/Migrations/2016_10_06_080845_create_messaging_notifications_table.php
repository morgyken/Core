<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagingNotificationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('core_notifications', function (Blueprint $column) {
            $column->increments('id');
            $column->integer('user_id')->unsigned();
            $column->integer('group')->unsigned()->nullable();
            $column->string('type')->nullable();
            $column->string('icon_class')->default('info');
            $column->string('link')->nullable();
            $column->string('title');
            $column->string('message');
            $column->boolean('is_read')->default(false);
            $column->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('core_notifications');
    }

}
