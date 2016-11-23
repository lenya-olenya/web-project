<?php

abstract class Model
{
    protected $_conn;
    protected $_tableName;

    public function __construct($tableName)
    {
        $this->_tableName = $tableName;

        $dsn = 'mysql:host=' . Application::$config['database']['host'] . ';' .
            'dbname=' . Application::$config['database']['name'];

        $this->_conn = new PDO(
            $dsn,
            Application::$config['database']['user'],
            Application::$config['database']['password']
        );

        $this->_conn->exec('SET NAMES utf8');
    }

    public function getCount()
    {
        $query = "SELECT COUNT(*) FROM `{$this->_tableName}`";
        $result = $this->_conn->query($query);

        return intval($result->fetch()[0]);
    }

    public function get($id)
    {
        $query = "SELECT * FROM `{$this->_tableName}` WHERE id=:id";
        $statement = $this->_conn->prepare($query);

        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getList($offset = null, $limit = null)
    {
        if (!isset($offset) && !isset($limit)) {
            $query = "SELECT * FROM `{$this->_tableName}`";
            $statement = $this->_conn->prepare($query);
        } elseif (!isset($offset) && isset($limit)) {
            $query = "SELECT * FROM `{$this->_tableName}` LIMIT :lim";
            $statement = $this->_conn->prepare($query);
            $statement->bindParam(':lim', $limit, PDO::PARAM_INT);
        } elseif (isset($offset) && !isset($limit)) {
            $query = "SELECT * FROM `{$this->_tableName}` LIMIT :off, :lim";
            $statement = $this->_conn->prepare($query);
            $statement->bindParam(':off', $offset, PDO::PARAM_INT);
            $statement->bindValue(':lim', (int) $this->getCount(), PDO::PARAM_INT);
        } else {
            $query = "SELECT * FROM `{$this->_tableName}` LIMIT :off, :lim";
            $statement = $this->_conn->prepare($query);
            $statement->bindParam(':off', $offset, PDO::PARAM_INT);
            $statement->bindParam(':lim', $limit, PDO::PARAM_INT);
        }

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $query = "DELETE FROM `{$this->_tableName}` WHERE `id` = :id";
        $statement = $this->_conn->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        return $statement->execute();
    }
}