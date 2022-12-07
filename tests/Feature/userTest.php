<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class userTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAdminUserLogin()
    {
        $this->withoutExceptionHandling();
        $data=User::factory()->count(5)->create();
//        dd($data);
//        User::created($data);
        $this->assertDatabaseCount('users',5);

        }
}
