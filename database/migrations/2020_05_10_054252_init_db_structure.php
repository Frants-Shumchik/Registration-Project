<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitDbStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('personal_code');
            $table->integer('organization_id');
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });

        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->integer('admin_id')->nullable();
            $table->timestamps();
        });

        Schema::create('question_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('answer');
            $table->integer('question_id');
            $table->timestamps();
        });

        Schema::create('question_types',  function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('roles',  function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('test_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('question');
            $table->integer('correct_answer_id')->nullable();
            $table->integer('test_id');
            $table->integer('type_id');
        });

        Schema::create('tests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->integer('available_time')->nullable();
            $table->boolean('is_active');
            $table->integer('organization_id');
            $table->timestamps();
        });

        Schema::create('tests_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('spent_time');
            $table->integer('correct');
            $table->string('mark');
            $table->integer('test_id');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('organization_members');
        Schema::drop('organizations');
        Schema::drop('question_answers');
        Schema::drop('question_types');
        Schema::drop('roles');
        Schema::drop('test_questions');
        Schema::drop('tests');
        Schema::drop('tests_results');
    }
}
