<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // Setting key (site_name, contact_email, etc)
            $table->longText('value')->nullable(); // Setting value
            $table->string('type')->default('string'); // Type: string, boolean, text, etc
            $table->string('group')->default('general'); // Group: general, contact, policies, seo, system
            $table->timestamps();
            
            $table->index('group');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
