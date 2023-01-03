<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBotController extends Controller
{
    public function updatedActivity()
    {
        $activity=Telegram::getUpdates();
        dd($activity);


    }

    public function call_madeline()
    {
        return view('Bot/madelineFile');

    }
//    public function updatedActivity()
//    {
//        $activity = Telegram::getUpdates();
//        dd($activity);
//    }
}
