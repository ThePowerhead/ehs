<?php
namespace EHS\Controllers;

use EHS\Main;

class Home {
    public function index() {
        return Main::view('index');
    }
}
