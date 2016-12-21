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
        $this->adressLocalNo = "";
        $this->postalCode = "";
        $this->adressCity = "";
    }

    public function getId() {
        return $this->id;
    }

    public function setId($newId) {
        if (is_numeric($newId)) {
            $this->id = $newId;
        }
        return $this;
    }

    public function setName($newName) {
        if (is_string($newName)) {
            $this->name = $newName;
        }
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setSurname($newSurname) {
        if (is_string($newSurname)) {
            $this->surname = $newSurname;
        }
        return $this;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function setPassword($newPassword) {
        $newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $this->hashedPassword = $newHashedPassword;
        return $this;
    }

    public function getHashedPassword() {
        return $this->hashedPassword;
    }

    public function setEmail($newEmail) {
        if (filter_var($newEmail, FILTER_VALIDATE_EMAIL) == true) {
            $this->email = $newEmail;
        }
        return $this;
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
        return $this;
    }

    public function getAdressLocalNo() {
        return $this->adressLocalNo;
    }

    public function setAdressLocalNo($newAdressLocal) {
        if (is_numeric($newAdressLocal) || is_string($newAdressLocal)) {
            $this->adressLocalNo = $newAdressLocal;
        }
        return $this;
    }

    public function getPostalCode() {
        return $this->postalCode;
    }

    public function setPostalCode($newPostalCode) {
        if (is_string($newPostalCode)) {
            $this->postalCode = $newPostalCode;
        }
        return $this;
    }

    public function getAdressCity() {
        return $this->adressCity;
    }

    public function setAdresscity($newAdressCity) {
        if (is_string($newAdressCity)) {
            $this->adressCity = $newAdressCity;
        }
        return $this;
    }

    public function saveToDB(mysqli $connection) {

        if ($this->id == -1) {

            //Saving new user to DB

            $sql = "INSERT INTO Users(name, surname, hashed_password, email,
                adress_street, adress_local, postal_code, adress_city)
                   VALUES ('$this->name', '$this->surname', '$this->hashedPassword', '$this->email',
                     '$this->adressStreet', '$this->adressLocalNo', '$this->postalCode', '$this->adressCity')";

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
    //metoda sprawdza czy jest email w bazie i porównuje z hasłem
    static public function loginUser(mysqli $conn, $email, $password) {
        $sql = "SELECT * FROM Users WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            //zwracamy wynik jako tabl assocjacyjne, gdzi kluczami sa nazwy kolumn
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['hashed_password'])) {
                return $row['id'];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    //metoda sprawdza czy jest dostępny adres email w bazie
    static public
            function emailIsAvailable(mysqli $connection, $email) {
        $sql = "SELECT * FROM Users WHERE `email`='$email'";
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows == 0) {
            return true;
        }
        return false;
    }
}
