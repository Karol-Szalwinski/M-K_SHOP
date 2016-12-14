<?php
/**
 * klasa administratora:
 * -możliwość zakładania/usuwania konta administratora
 * -możliwość wyświetlania danych admiistratora wg id/maila
 * -logowanie dla administratora
 */
class Admin {

    private $id;
    private $name;
    private $email;
    private $hashedPassword;

    public function __construct() {
        $this->id = -1;
        $this->name = "";
        $this->email = "";
        $this->hashedPassword = "";
    }

    public function getId() {
        return $this->id;
    }

    public function setId($newId) {
        if (is_numeric($newId)) {
            $this->id = $newId;
        }
    }

    public function setName($newName) {
        if (is_string($newName)) {
            $this->name = $newName;
        }
    }

    public function getName() {
        return $this->name;
    }

    public function setEmail($newEmail) {
        if (filter_var($newEmail, FILTER_VALIDATE_EMAIL) == true) {
            $this->email = $newEmail;
        }
    }

    public function getEmail() {
        return $this->email;
    }

    public function setPassword($newPassword) {
        $newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $this->hashedPassword = $newHashedPassword;
    }

    public function getHashedPassword() {
        return $this->hashedPassword;
    }

    public function saveToDB(mysqli $connection) {

        if ($this->id == -1) {

            //Saving new Admin to DB

            $sql = "INSERT INTO Admin(name, email, hashed_password)
                   VALUES ('$this->name', '$this->semail', '$this->hashedPassword')";

            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;

                return true;
            } else {

                return false;
            }
        } else {
            $sql = "UPDATE Admin SET name='$this->name', email='$this->email',
                    hashed_password='$this->hashedPassword' 
                    WHERE id=$this->id";

            $result = $connection->query($sql);

            if ($result == true) {
                return true;
            } else {
                return false;
            }
        }
    }

    static public function loadAdminById(mysqli $connection, $id) {

        $sql = "SELECT * FROM Admin WHERE id=$id";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {

            $row = $result->fetch_assoc();
            $loadedAdmin = new Admin();
            $loadedAdmin->id = $row['id'];
            $loadedAdmin->name = $row['name'];
            $loadedAdmin->email = $row['email'];
            $loadedAdmin->hashedPassword = $row['hashed_password'];


            return $loadedAdmin;
        }

        return null;
    }

        static public function loadAdminByEmail(mysqli $connection, $email) {

        $sql = "SELECT * FROM Admin WHERE email='$email'";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {

            $row = $result->fetch_assoc();
            $loadedAdmin = new Admin();
            $loadedAdmin->id = $row['id'];
            $loadedAdmin->name = $row['name'];
            $loadedAdmin->email = $row['email'];
            $loadedAdmin->hashedPassword = $row['hashed_password'];

            return $loadedAdmin;
        }

        return null;
    }
   
    static public function logIn(mysqli $connection, $email, $password) {
        $loadedAdmin = self::loadUserByEmail($connection, $email);

        if (password_verify($password, $loadedAdmin->hashedPassword)) {
            return $loadedAdmin;
        } else {
            return false;
        }
    }

}
