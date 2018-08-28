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
        // fetch account associated to the email
        // Returns nothing if no email associated
        $query = "SELECT id FROM account where email=:email limit 1";
        $stmt = Main::$db->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        
        if ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
            return new self($id);
        }
        return NULL;
    }
        
    public static function hashpass($password, $hashkey) {
        return (\hash("sha256", $password . $hashkey));
    }

    public function __construct($id = NULL) {
        if ($id == NULL) {
            $this->isNew = TRUE;
            $this->id = Uuid::uuid4();
            $this->hashkey = Uuid::uuid4();
        }
        else {
            $this->isNew = FALSE;
            $this->id = $id;

            $query = "SELECT * FROM account where id=:id limit 1";
            $stmt = Main::$db->prepare($query);
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();

            if ($account = $stmt->fetch(PDO::FETCH_OBJ)) {
                $this->email = $account->email;
                $this->hashpass = $account->haspass;
                $this->hashkey = $account->hashkey;
            }
            else {
                throw new Exception("Le compte $id n'existe pas");
            }

            $stmt = null;
        }
    }

    public function save() {
        // Create in database or update it
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
        $stmt->execute();
        $stmt = null;
        
    }

    // get\set or not
    public function setEmail($email) {
        $this->email = $email;
    }

    public function setHashpass($hashpass) {
        $this->hashpass = $hashpass;
    }

    public function setHashkey($hashkey) {
        $this->hashkey = $hashkey;
    }

    public function getHashkey() {
        return $this->hashkey;
    }
}