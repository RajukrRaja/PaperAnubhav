<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('communities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('category')->default('General');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('community_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('community_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['community_id', 'user_id']);
        });

        Schema::create('community_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('community_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('body');
            $table->timestamps();
            $table->index(['community_id', 'id']);
        });

        $now = now();
        DB::table('communities')->insert([
            ['name' => 'RRB Exams', 'slug' => 'rrb-exams', 'description' => 'Discuss RRB NTPC, Group D, ALP and Technician exams.', 'category' => 'Railway', 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'SSC & Government Exams', 'slug' => 'ssc-government-exams', 'description' => 'Preparation, exam updates and candidate experiences for SSC and other government exams.', 'category' => 'Government', 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Interview & Career', 'slug' => 'interview-career', 'description' => 'Share interview experiences, job-search advice and career questions.', 'category' => 'Career', 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('community_messages');
        Schema::dropIfExists('community_user');
        Schema::dropIfExists('communities');
    }
};
