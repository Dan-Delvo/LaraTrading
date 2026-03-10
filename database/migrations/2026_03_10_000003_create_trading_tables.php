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
        Schema::create('exchange_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name')->default('Primary Exchange');
            $table->string('exchange')->default('binance');
            $table->string('environment')->default('live');
            $table->text('api_key');
            $table->text('api_secret');
            $table->text('api_passphrase')->nullable();
            $table->string('status')->default('disconnected');
            $table->timestampTz('last_tested_at')->nullable();
            $table->timestampTz('last_connected_at')->nullable();
            $table->text('last_error_message')->nullable();
            $table->json('metadata')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['user_id', 'exchange']);
        });

        Schema::create('ai_provider_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name')->default('Primary AI Provider');
            $table->string('provider')->default('openai');
            $table->string('model')->nullable();
            $table->string('base_url')->nullable();
            $table->text('api_key');
            $table->string('status')->default('disconnected');
            $table->timestampTz('last_tested_at')->nullable();
            $table->text('last_error_message')->nullable();
            $table->json('metadata')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['user_id', 'provider']);
        });

        Schema::create('trading_configurations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('exchange_account_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('ai_provider_account_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name')->default('Default Configuration');
            $table->string('default_symbol')->nullable();
            $table->string('default_timeframe')->nullable();
            $table->string('automation_mode')->default('manual');
            $table->string('default_ai_strategy')->default('balanced');
            $table->decimal('default_risk_reward_ratio', 8, 2)->nullable();
            $table->decimal('default_risk_per_trade_percent', 8, 2)->nullable();
            $table->decimal('max_position_size_usdt', 18, 8)->nullable();
            $table->decimal('daily_stop_loss_limit_percent', 8, 2)->nullable();
            $table->decimal('daily_loss_limit_usdt', 18, 8)->nullable();
            $table->decimal('max_leverage', 8, 2)->nullable();
            $table->integer('max_open_positions')->default(1);
            $table->boolean('allow_long_trades')->default(true);
            $table->boolean('allow_short_trades')->default(true);
            $table->boolean('is_active')->default(true);
            $table->json('rules')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'name']);
        });

        Schema::create('trade_signals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('trading_configuration_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('exchange_account_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('ai_provider_account_id')->nullable()->constrained()->nullOnDelete();
            $table->string('source')->default('manual_ai');
            $table->string('symbol')->nullable();
            $table->string('timeframe')->nullable();
            $table->string('status')->default('success');
            $table->string('action', 16);
            $table->string('ai_strategy')->nullable();
            $table->decimal('entry_price', 18, 8)->nullable();
            $table->decimal('take_profit', 18, 8)->nullable();
            $table->decimal('stop_loss', 18, 8)->nullable();
            $table->decimal('risk_reward_ratio', 10, 4)->nullable();
            $table->decimal('risk_per_trade_percent', 8, 2)->nullable();
            $table->decimal('recommended_position_size', 18, 8)->nullable();
            $table->text('rationale')->nullable();
            $table->string('analysis_time')->nullable();
            $table->unsignedInteger('analysis_time_seconds')->nullable();
            $table->timestampTz('signal_timestamp');
            $table->json('payload')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'signal_timestamp']);
            $table->index(['user_id', 'source']);
            $table->index(['user_id', 'action']);
            $table->index(['user_id', 'status']);
        });

        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('trade_signal_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('exchange_account_id')->nullable()->constrained()->nullOnDelete();
            $table->string('symbol');
            $table->string('side', 16);
            $table->string('status')->default('pending');
            $table->decimal('quantity', 18, 8)->nullable();
            $table->decimal('entry_price', 18, 8)->nullable();
            $table->decimal('exit_price', 18, 8)->nullable();
            $table->decimal('take_profit', 18, 8)->nullable();
            $table->decimal('stop_loss', 18, 8)->nullable();
            $table->decimal('risk_reward_ratio', 10, 4)->nullable();
            $table->decimal('fees', 18, 8)->nullable();
            $table->decimal('gross_pnl', 18, 8)->nullable();
            $table->decimal('net_pnl', 18, 8)->nullable();
            $table->decimal('pnl_percent', 8, 2)->nullable();
            $table->timestampTz('opened_at')->nullable();
            $table->timestampTz('closed_at')->nullable();
            $table->string('external_order_id')->nullable();
            $table->text('notes')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index(['user_id', 'symbol']);
            $table->index(['user_id', 'opened_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trades');
        Schema::dropIfExists('trade_signals');
        Schema::dropIfExists('trading_configurations');
        Schema::dropIfExists('ai_provider_accounts');
        Schema::dropIfExists('exchange_accounts');
    }
};
