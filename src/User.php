<?php

/**
 * klasa użytkownika:
 * -możliwość zakładania/usuwania konta użytkownika
 * -możliwość wyświetlania danych użytkownika wg id/maila
 * -wyświetlanie wszytskich użytkowników, logowanie
 */
class User {

    private $id;
    private $name;
    private $surname;
    private $hashedPassword;
    private $email;
    private $adressStreet;
    private $adressLocalNo;
    private $postalCode;
    private $adressCity;

    public function __construct() {

        $this->id = -1;
        $this->name = "";
        $this->surname = "";
        $this->hashedPassword = "";
        $this->email = "";
        $this->adressStreet = "";
        $this->adressLocalNo = 0;
        $this->postalCode = 0;
        $this->adressCity = "";
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

    public function setSurname($newSurname) {
        if (is_string($newSurname)) {
            $this->surname = $newSurname;
        }
    }

    public function getSurname() {
        return $this->surname;
    }

    public function setPassword($newPassword) {
        $newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $this->hashedPassword = $newHashedPassword;
    }

    public function getHashedPassword() {
        return $this->hashedPassword;
    }

    public function setEmail($newEmail) {
        if (filter_var($newEmail, FILTER_VALIDATE_EMAIL) == true) {
            $this->email = $newEmail;
        }
    }

    public function getEmail() {
        return $this->email;
    }

    public function verifyPassword($password) {
        return password_verify($password, $this->hashedPassword);
    }

    public function getAdressStreet() {
        return $this->adressStreet;
    }

    public function setAdressStreet($newAdressStreet) {
        if (is_string($newAdressStreet)) {
            $this->adressStreet = $newAdressStreet;
        }
    }

    public function getAdressLocalNo() {
        return $this->adressLocalNo;
    }

    public function setAdressLocalNo($newAdressLocal) {
        if (is_numeric($newAdressLocal) || is_string($newAdressLocal)) {
            $this->adressLocalNo = $newAdressLocal;
        }
    }

    public function getPostalCode() {
        return $this->postalCode;
    }

    public function setPostalCode($newPostalCode) {
        if (is_numeric($newPostalCode)) {
            $this->postalCode = $newPostalCode;
        }
    }

    public function getAdressCity() {
        return $this->adressCity;
    }

    public function setAdresscity($newAdressCity) {
        if (is_string($newAdressCity)) {
            $this->adressCity = $newAdressCity;
        }
    }

    public function saveToDB(mysqli $connection) {

        if ($this->id == -1) {

            //Saving new user to DB

            $sql = "INSERT INTO Users(name, surname, hashed_password, email, adress_street, adress_local, postal_code, adress_city)
                   VALUES ('$this->name', '$this->surname', '$this->hashedPassword', '$this->email', '$this->adressStreet', '$this->adressLocalNo', '$this->postalCode', '$this->adressCity')";

            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;

                return true;
            } else {

                return false;
            }
        } else {
            $sql = "UPDATE Users SET name='$this->name', surname='$this->surname',
                    hashed_password='$this->hashedPassword',email='$this->email',
                    adress_street='$this->adressStreet', adress_local='$this->adressLocalNo', 
                    postal_code='$this->postalCode', adress_city='$this->adressCity'    
                    WHERE id=$this->id";

            $result = $connection->query($sql);

            if ($result == true) {
                return true;
            } else {
                return false;
            }
        }
    }

    static public function loadUserById(mysqli $connection, $id) {

        $sql = "SELECT * FROM Users WHERE id=$id";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {

            $row = $result->fetch_assoc();
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->name = $row['name'];
            $loadedUser->surname = $row['surname'];
            $loadedUser->hashedPassword = $row['hashed_password'];
            $loadedUser->email = $row['email'];
            $loadedUser->adressStreet = $row['adress_street'];
            $loadedUser->adressLocalNo = $row['adress_local'];
            $loadedUser->postalCode = $row['postal_code'];
            $loadedUser->adressCity = $row['adress_city'];

            return $loadedUser;
        }

        return null;
    }

    static public function loadAllUsers(mysqli $connection) {

        $sql = "SELECT * FROM Users";
        $ret = [];

        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {

                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->name = $row['name'];
                $loadedUser->surname = $row['surname'];
                $loadedUser->hashedPassword = $row['hashed_password'];
                $loadedUser->email = $row['email'];
                $loadedUser->adressStreet = $row['adress_street'];
                $loadedUser->adressLocalNo = $row['adress_local'];
                $loadedUser->postalCode = $row['postal_code'];
                $loadedUser->adressCity = $row['adress_city'];

                $ret[] = $loadedUser;
            }
        }

        return $ret;
    }

    public function delete(mysqli $connection) {

        if ($this->id != -1) {
            $sql = "DELETE FROM Users WHERE id=$this->id";
            $result = $connection->query($sql);
            if ($result == true) {

                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }

    static public function loadUserByEmail(mysqli $connection, $email) {

        $sql = "SELECT * FROM Users WHERE email='$email'";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {

            $row = $result->fetch_assoc();
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->name = $row['name'];
            $loadedUser->surname = $row['surname'];
            $loadedUser->hashedPassword = $row['hashed_password'];
            $loadedUser->email = $row['email'];
            $loadedUser->adressStreet = $row['adress_street'];
            $loadedUser->adressLocalNo = $row['adress_local'];
            $loadedUser->postalCode = $row['postal_code'];
            $loadedUser->adressCity = $row['adress_city'];
            return $loadedUser;
        }

        return null;
    }

    static public function logIn(mysqli $connection, $email, $password) {
        $loadedUser = self::loadUserByEmail($connection, $email);

        if (password_verify($password, $loadedUser->hashedPassword)) {
            return $loadedUser;
        } else {
            return false;
        }
    }

}
