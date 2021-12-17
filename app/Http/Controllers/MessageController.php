<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MessageController extends Controller
{
    public function create(Request $request)
    {
      DB::table('messages')->insert([
        'user_id' => $request->user_id,
        'message' => $request->message,
        'created_at' => now(),
      ]);
    }

    public function read(Request $request)
    {
      $messages = DB::table('messages')->get();
      return json_encode($messages);
    }
}
