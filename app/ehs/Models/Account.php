<?php
namespace EHS\Models;

use Ramsey\Uuid\Uuid;
use EHS\Main;

// Objet qui représente un élément de ma base de donnée -> table
// Voir modèle mvc


class Account {

    private $id;
    private $email;
    private $hashpass;
    private $hashkey;
    private $isNew = FALSE;

    public static function fromEmail($email) {
        // call pdo function to find id from email in table account
        // Main::$db->PODiutenrauetate();

        return new self($id);
    }
        
    public function __construct($id = NULL) {
        if ($id == NULL) {
            $this->isNew = TRUE;
            $this->id = Uuid::uuid4();
            $this->hashkey = Uuid::uuid4();
        }
        else {

        }
    }

    public function save() {
        // KK : new data or update data
        // if isNew then new data
        if ($this->isNew) {
            $query = "INSERT INTO account(idaccount, email, hashpass, hashkey) VALUES (:id, :email, :hashpass, :hashkey)";
            $this->isNew = FALSE;
        }
        else {
            // If already existing, find related account and update it
            $query = "UPDATE account email = :email, hashpass = :hashpass, hashkey = :hashkey WHERE idaccount = :id";
        }

        $stmt = Main::$db->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":hashpass", $this->hashpass);
        $stmt->bindParam(":hashkey", $this->hashkey);
        
        echo $idaccount;
        echo $email;
        echo $hashpass;
        echo $hashkey;

        $stmt->execute();
        $stmt = null;
        
    }

    // get\set or not
    // static : all pass related except at creation
    public function setEmail($email) {
        $this->email = $email;
    }

    public function setHashpass($hashpass) {
        $this->hashpass = $hashpass;
    }

    public function setHashkey($hashkey) {
        $this->hashkey = $hashkey;
    }

    public static function hashpass($password, $hashkey) {
        return (\hash("sha256", $password . $hashkey));
    }

    public function getHashkey() {
        return $this->hashkey;
    }
}