<?php

namespace EHS\Models;

use Ramsey\Uuid\Uuid;
use EHS\Main;

// Représente le joueur
// Clés : PK_idplayer, pseudo, level, FK_account, experience

class Player {

    private $id;
    private $pseudo;
    private $level;
    private $account;
    private $experience;
    private $isNew = FALSE;

    public function __construct($id = NULL) {
        if ($id == NULL) {
            $this->id = Uuid::uuid4();
            $this->level = 1;
            $this->experience = 0;
            $this->isNew = TRUE;
            $this->account = NULL;
        }
        else {
            $this->isNew = FALSE;

            $query = "SELECT * FROM player where idplayer = :id limit 1";
            
            $stmt = Main::$db->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            if($player = $stmt->fetch(PDO::FETCH_OBJ)) {
                // https://stackoverflow.com/questions/13183579/pdo-get-data-from-database
                // http://php.net/manual/fr/pdostatement.fetch.php
                $this->account = new Account($player->account);
                $this->pseudo = $player->pseudo;
                $this->level = $player->level;
                $this->experience = $player->experience;
            }            
        }
    }

    public function save() {
        if ($this->isNew) {
            $query = "INSERT INTO player(idplayer, pseudo, level, account, experience) VALUES ($this->id, $this->pseudo, $this->level, $this->account, $this->experience)";
            $this->isNew = FALSE;
        }
        else {
            $query = "UPDATE player level = $level, experience = $experience ";
        }

        $stmt = Main::$db->prepare($query);
        $stmt->bindParam("idplayer", $this->id);
        $stmt->bindParam("level", $this->level);
        $stmt->bindParam("account", $this->account->id);
        $stmt->bindParam("experience", $this->experience);
        
        $stmt->execute();
        $stmt = null;
    }

    public function setPseudo($name) {
        $this->$pseudo = $name;
    }

    public function getPseudo() {
        return $this->pseudo;
    }

    public function getLevel() {
        return $this->level;
    }

    public function setLevel($level) {
        $this->level = $level;
    }

    public function getExperience() {
        return $this->experience;
    }

    public function setExperience($exp) {
        $this->experience = $exp;
    }

    public function getAccount() {
        return $this->account;
    }

    public function setAccount(Account $account) {
        $this->account = $account;
    }
}