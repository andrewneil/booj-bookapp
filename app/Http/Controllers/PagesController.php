<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// THIS CONTROLLER PRETTY MUCH CONTAINS FUNCTIONS THAT RETURNS BACK VIEWS 
class PagesController extends Controller
{
    public function index() // this when called goes to the Index page
    {
       $title = 'Welcome to BookApp'; // place this variable between {{$variable}} html tags to display variable contents
       // return 'INDEX'; // this just returns text that says INDEX
       //return view('pages.index', compact('title')); // this returns the view that is under the pages folder
       return view('pages.index')->with('title', $title); // alternative way of above ^^^^, also if you want to add multiple values
                                                          // such as an Array
    }

    public function about() //  this when called goes to the About page
    {
        $title = 'About Us';
        return view('pages.about')->with('title', $title);  // this makes the title Dynamic, ->with(); passes in 
    }

    public function services() // this when called goes to the Services page
    {
        // passes in multiple values
        $data = array(
            'title' => 'Services',
            'services' => ['Books', 'Tracking Lists', 'Kindle'] // the 'services' => is a variable ???
        ); // assoicative array, key-valued pairs
        return view('pages.services')->with($data);
    }
}
