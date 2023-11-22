<?php

namespace LaravelCommon\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class IntegrationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Set the database connection to sqlite for testing
        // DB::connection('sqlite');

        // Run your migrations
        $this->artisan('migrate');

        // Seed your database
        $this->seed();
    }

    public function tearDown(): void
    {
        // DB::connection('sqlite');

        $this->artisan('migrate:rollback');

        parent::tearDown();
    }
}
