<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['title'] = "Portal Berita";
        $data['bannertitle'] = "Portal Berita";
        $data['content'] = "pages/home";

        echo view('index', $data);
    }

    public function contact()
    {
        $data['title'] = "Contact Us";
        $data['bannertitle'] = "Contact Us";
        $data['content'] = "pages/contact";

        echo view("index", $data);
    }
}
