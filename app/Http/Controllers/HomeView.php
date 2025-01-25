<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeView extends Controller
{
    public function index()
    {
        // Return the home view
        return view('homeview.index');
    }
    public function mdm()
    {
        // Return the home view
        return view('homeview.mdm');
    }
    public function kiosklockdown()
    {
        // Return the home view
        return view('homeview.kiosklockdown');
    }
    public function contact_us()
    {
        // Return the home view
        return view('homeview.contact-us');
    }
    public function digital_signage()
    {
        // Return the home view
        return view('homeview.digital-signage');
    }
    public function support()
    {
        // Return the home view
        return view('homeview.support');
    }
    public function become_our_partner()
    {
        // Return the home view
        return view('homeview.become-our-partner');
    }

    public function request_a_demo()
    {
        // Return the home view
        return view('homeview.request-a-demo');
    }
}
