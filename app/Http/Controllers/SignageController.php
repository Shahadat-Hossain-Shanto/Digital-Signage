<?php

namespace App\Http\Controllers;

use App\Models\PlayList;
use Illuminate\Support\Facades\DB;


class SignageController extends Controller
{
    public function index (){
        return view('signage.signage');
    }

    public function view (){
        return view('signage.digital_signage');
    }
    public function index1 (){
        $playlists = DB::table('play_lists')
        ->select( 'playlist_name')
        ->groupBy('playlist_name')
        ->get();
    
        return view('signage.signage1',compact('playlists'));
    }
}
