<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('username', 50)->unique();
            $table->string('email', 30)->unique();
            $table->timestamp('email_verified')->nullable();
            $table->string('password', 255);
            $table->enum('u_type', ['admin', 'customer'])->default('customer');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};