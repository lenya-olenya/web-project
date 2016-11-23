<?php

require_once ROOT . '/models/Model.php';

class ThemeModel extends Model
{
    public function __construct()
    {
        parent::__construct('theme');
    }

    // Create-methods

    public function add($name = null, $description = null, $published = false)
    {
        $query = 'INSERT INTO `theme` (`name`, `description`, `published`) VALUES (:n, :d, :p)';
        $statement = $this->_conn->prepare($query);

        $statement->bindParam(':n', $name, PDO::PARAM_STR);
        $statement->bindParam(':d', $description, PDO::PARAM_STR);
        $statement->bindParam(':p', $published, PDO::PARAM_BOOL);

        $statement->execute();

        return $this->_conn->lastInsertId();
    }

    // Read-methods

    public function getListPublished($published = true, $offset = null, $limit = null)
    {
        if (!isset($offset) && !isset($limit)) {
            $query = 'SELECT * FROM `theme` WHERE `published` = :p';
            $statement = $this->_conn->prepare($query);
            $statement->bindParam(':p', $published, PDO::PARAM_BOOL);
        } elseif (!isset($offset) && isset($limit)) {
            $query = 'SELECT * FROM `theme` WHERE `published` = :p LIMIT :lim';
            $statement = $this->_conn->prepare($query);
            $statement->bindParam(':p', $published, PDO::PARAM_BOOL);
            $statement->bindParam(':lim', $limit, PDO::PARAM_INT);
        } elseif (isset($offset) && !isset($limit)) {
            $query = 'SELECT * FROM `theme` WHERE `published` = :p LIMIT :off, :lim';
            $statement = $this->_conn->prepare($query);
            $statement->bindParam(':p', $published, PDO::PARAM_BOOL);
            $statement->bindParam(':off', $offset, PDO::PARAM_INT);
            $statement->bindValue(':lim', (int) $this->getCount(), PDO::PARAM_INT);
        } else {
            $query = 'SELECT * FROM `theme` WHERE `published` = :p LIMIT :off, :lim';
            $statement = $this->_conn->prepare($query);
            $statement->bindParam(':p', $published, PDO::PARAM_BOOL);
            $statement->bindParam(':off', $offset, PDO::PARAM_INT);
            $statement->bindParam(':lim', $limit, PDO::PARAM_INT);
        }

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getName($id)
    {
        $query = 'SELECT `name` FROM `theme` WHERE `id` = :id';
        $statement = $this->_conn->prepare($query);

        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_NUM)[0];
    }

    public function getDescription($id)
    {
        $query = 'SELECT `description` FROM `theme` WHERE `id` = :id';
        $statement = $this->_conn->prepare($query);

        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_NUM)[0];
    }

    public function isPublished($id)
    {
        $query = 'SELECT `published` FROM `theme` WHERE `id` = :id';
        $statement = $this->_conn->prepare($query);

        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return (boolean) $statement->fetch(PDO::FETCH_NUM)[0];
    }

    // Update-methods

    public function setName($id, $name)
    {
        $query = 'UPDATE `theme` SET `name` = :new_name WHERE `id` = :id';
        $statement = $this->_conn->prepare($query);

        $statement->bindParam(':new_name', $name, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        return $statement->execute();
    }

    public function setDescription($id, $description)
    {
        $query = 'UPDATE `theme` SET `description` = :new_description WHERE `id` = :id';
        $statement = $this->_conn->prepare($query);

        $statement->bindParam(':new_description', $description, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        return $statement->execute();
    }

    public function setPublished($id, $published)
    {
        $query = 'UPDATE `theme` SET `description` = :new_published WHERE `id` = :id';
        $statement = $this->_conn->prepare($query);

        $statement->bindParam(':new_published', $published, PDO::PARAM_BOOL);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        return $statement->execute();
    }
}
