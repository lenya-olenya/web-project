<?php

require_once ROOT . '/models/Model.php';

class AdminConfigModel extends Model
{
    public function __construct()
    {
        parent::__construct('admin_config');
    }

    // Read-methods

    public function getLogin()
    {
        $query = 'SELECT `login` FROM `admin_config`';
        $statement = $this->_conn->query($query);
        return $statement->fetch(PDO::FETCH_NUM)[0];
    }

    public function getPassword()
    {
        $query = 'SELECT `password` FROM `admin_config`';
        $statement = $this->_conn->query($query);
        return $statement->fetch(PDO::FETCH_NUM)[0];
    }

    // Update-methods

    public function setLogin($login)
    {
        if ($this->getCount() === 0) {
            $query = 'INSERT INTO `admin_config` (`login`) VALUES (:l)';
        } else {
            $query = 'UPDATE `admin_config` SET `login` = :l';
        }

        $statement = $this->_conn->prepare($query);

        $statement->bindParam(':l', $login);

        return $statement->execute();
    }

    public function setPassword($password)
    {
        if ($this->getCount() === 0) {
            $query = 'INSERT INTO `admin_config` (`password`) VALUES (:p)';
        } else {
            $query = 'UPDATE `admin_config` SET `password` = :p';
        }

        $statement = $this->_conn->prepare($query);

        $statement->bindParam(':p', $password);

        return $statement->execute();
    }
}
