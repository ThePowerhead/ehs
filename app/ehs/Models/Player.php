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
    private $account;
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

            $query = "SELECT * FROM player where idplayer = :id limit 1";
            
            $stmt = Main::$db->prepare($query);
            $stmt->bindParam(":id", $id);

            if ($stmt->execute()) {
                if($player = $stmt->fetch(PDO::FETCH_OBJ)) {
                    // stocke les données dans mes variables
                    // https://stackoverflow.com/questions/13183579/pdo-get-data-from-database
                    // http://php.net/manual/fr/pdostatement.fetch.php
                    
                }
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
        $stmt->bindParam("account", $this->account);
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

    public function setAccount($account) {
        $this->account = $account;
    }
}