<?php

declare(strict_types=1);

use App\Enums\RoomType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('rooms', static function (Blueprint $table): void {
            $table->uuid('id')->primary();

            $table->string('name'); // 104
            $table->string('label'); // Honeymoon Suite
            $table->string('view'); // City View
            $table->string('accessible')->nullable(); // Wheelchair access
            $table->string('type')->default(RoomType::Double->value);

            $table->text('description')->nullable();

            $table->unsignedInteger('sleeps')->default(1);
            $table->unsignedBigInteger('size')->default(0);
            $table->unsignedBigInteger('daily_rate')->default(0);
            $table->unsignedInteger('weekly_rate')->default(0);

            $table
                ->foreignUuid('floor_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
