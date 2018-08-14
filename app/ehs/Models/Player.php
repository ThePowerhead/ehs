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
        }
        else {
            $this->level = $level;
            $this->experience = $experience;
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
        $this->level = $exp;
    }
}