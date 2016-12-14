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

    public function __construct() {

        $this->id = -1;
        $this->name = "";
        $this->surname = "";
        $this->hashedPassword = "";
        $this->email = "";
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

    public function saveToDB(mysqli $connection) {

        if ($this->id == -1) {

            //Saving new user to DB

            $sql = "INSERT INTO Users(name, surname, hashed_password, email)
                   VALUES ('$this->name', '$this->surname', '$this->hashedPassword', '$this->email')";

            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;

                return true;
            } else {

                return false;
            }
        } else {
            $sql = "UPDATE Users SET name='$this->name', surname='$this->surname',
                    hashed_password='$this->hashedPassword',email='$this->email'  
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
