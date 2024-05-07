<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sent_emails', function (Blueprint $table) {
            $table->id();
            $table->string('recipient'); // Email address of the recipient
            $table->string('subject'); // Subject of the email
            $table->text('body'); // Body of the email
            $table->foreignId('user_id')->constrained('users');
            $table->timestamp('sent_at')->nullable(); // Timestamp when the email was sent
            $table->timestamps(); // Automatically manage created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sent_emails');
    }
};
