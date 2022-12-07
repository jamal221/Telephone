<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class loginTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLoginForm()
    {

        $this->browse(function (Browser $browser) {
            $user=User::factory()->make();
//        dd($user);
            $browser->visit('/loginlogin')
                    ->type('userName',$user->Emd_id)
                    ->type('userPassword', $user->password)
                    ->press('ورود')
                    ->pause('3000')
                    ->assertSee('Admin Pannel');
        });
    }
}
