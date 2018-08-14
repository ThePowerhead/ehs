<?php
namespace EHS\Controllers;

use EHS\Models\Account;
use EHS\Models\Player;
use EHS\Main;
use EHS\Notify;
use EHS\Parameters;

class User {
    public function register() {
        // Arriving here from index via inscription button
        $vars = ['title' => 'EHS - Inscription'];        
        return Main::view('register', $vars);
    }

    public function doRegister() {
        // database registration action here
        // When creating account, haskey is created along with id
        $account = new Account();
        $account->setEmail(Parameters::post("mail"));
        $account->setHashpass(Account::hashpass(Parameters::post("pass"), $account->getHashkey()));

        // create player with username given
        $player = new Player();
        $player->setAccount($account);
        $player->setPseudo(Parameters::post("name"));
        
        $account->save();
        $player->save();

        // call dologin
        Main::$notifies[] = new Notify("Inscription réussie", "success");

        return Main::view('index');
    }

    public function login() {
        $vars = ['title' => 'EHS - Connexion'];
        return Main::view('login', $vars);
    }

    public function doLogin() {
        // database validation credentials here

        // homepage with or not connection

    }

    public function home() {
        $vars = ['title' => 'EHS - Connexion'];        
        return Main::view('default', $vars);
    }
}
