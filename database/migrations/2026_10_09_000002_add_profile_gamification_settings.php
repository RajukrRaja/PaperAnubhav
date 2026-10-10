<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void {
  Schema::create('user_activities', function(Blueprint $t){$t->id();$t->foreignId('user_id')->constrained()->cascadeOnDelete();$t->date('activity_date');$t->string('activity_type',40)->default('visit');$t->unsignedInteger('points')->default(0);$t->timestamps();$t->unique(['user_id','activity_date','activity_type']);$t->index(['user_id','activity_date']);});
  Schema::create('site_settings', function(Blueprint $t){$t->id();$t->string('key')->unique();$t->text('value')->nullable();$t->string('type')->default('text');$t->timestamps();});
  Schema::create('user_goals', function(Blueprint $t){$t->id();$t->foreignId('user_id')->constrained()->cascadeOnDelete();$t->string('title');$t->unsignedSmallInteger('target')->default(1);$t->unsignedSmallInteger('progress')->default(0);$t->date('due_date')->nullable();$t->boolean('completed')->default(false);$t->timestamps();});
 }
 public function down(): void {Schema::dropIfExists('user_goals');Schema::dropIfExists('site_settings');Schema::dropIfExists('user_activities');}
};
