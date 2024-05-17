<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('customers', static function (Blueprint $table): void {
            $table->uuid('id')->primary();

            $table->uuidMorphs('billable');
            $table->string('paddle_id')->unique();
            $table->string('name');
            $table->string('email');

            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
