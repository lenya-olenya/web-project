<?php

require_once ROOT . '/models/Model.php';

class PublicationModel extends Model
{
    public function __construct()
    {
        parent::__construct('publication');
    }

    // Create-methods

    public function add(
        $title = null,
        $content = null,
        $description = null,
        $theme_id = null,
        $published = false
    ) {
        $query =
            'INSERT INTO `publication` (`title`, `content`, `description`, `theme_id`, `published`) ' .
            'VALUES (:ttl, :cntnt, :dscr, :tid, :p)';

        $statement = $this->_conn->prepare($query);

        $statement->bindParam(':ttl', $title, PDO::PARAM_STR);
        $statement->bindParam(':cntnt', $content, PDO::PARAM_STR);
        $statement->bindParam(':dscr', $description, PDO::PARAM_STR);
        $statement->bindParam(':tid', $theme_id, PDO::PARAM_INT);
        $statement->bindParam(':p', $published, PDO::PARAM_BOOL);

        $statement->execute();

        return $this->_conn->lastInsertId();
    }

    // Read-methods

    public function getListByThemeId($themeId, $offset = null, $limit = null)
    {
        if (!isset($offset) && !isset($limit)) {
            $query = 'SELECT * FROM `publication` WHERE `theme_id` = :tid';
            $statement = $this->_conn->prepare($query);
            $statement->bindParam(':tid', $themeId, PDO::PARAM_INT);
        } elseif (!isset($offset) && isset($limit)) {
            $query = 'SELECT * FROM `publication` WHERE `theme_id` = :tid LIMIT :lim';
            $statement = $this->_conn->prepare($query);
            $statement->bindParam(':tid', $themeId, PDO::PARAM_INT);
            $statement->bindParam(':lim', $limit, PDO::PARAM_INT);
        } elseif (isset($offset) && !isset($limit)) {
            $query = 'SELECT * FROM `publication` WHERE `theme_id` = :tid LIMIT :off, :lim';
            $statement = $this->_conn->prepare($query);
            $statement->bindParam(':tid', $themeId, PDO::PARAM_INT);
            $statement->bindParam(':off', $offset, PDO::PARAM_INT);
            $statement->bindValue(':lim', (int) $this->getCount(), PDO::PARAM_INT);
        } else {
            $query = 'SELECT * FROM `publication` WHERE `theme_id` = :tid LIMIT :off, :lim';
            $statement = $this->_conn->prepare($query);
            $statement->bindParam(':tid', $themeId, PDO::PARAM_INT);
            $statement->bindParam(':off', $offset, PDO::PARAM_INT);
            $statement->bindParam(':lim', $limit, PDO::PARAM_INT);
        }

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getListPublished($published = true, $offset = null, $limit = null)
    {
        if (!isset($offset) && !isset($limit)) {
            $query = 'SELECT * FROM `publication` WHERE `published` = :p';
            $statement = $this->_conn->prepare($query);
            $statement->bindParam(':p', $published, PDO::PARAM_BOOL);
        } elseif (!isset($offset) && isset($limit)) {
            $query = 'SELECT * FROM `publication` WHERE `published` = :p LIMIT :lim';
            $statement = $this->_conn->prepare($query);
            $statement->bindParam(':p', $published, PDO::PARAM_BOOL);
            $statement->bindParam(':lim', $limit, PDO::PARAM_INT);
        } elseif (isset($offset) && !isset($limit)) {
            $query = 'SELECT * FROM `publication` WHERE `published` = :p LIMIT :off, :lim';
            $statement = $this->_conn->prepare($query);
            $statement->bindParam(':p', $published, PDO::PARAM_BOOL);
            $statement->bindParam(':off', $offset, PDO::PARAM_INT);
            $statement->bindValue(':lim', (int) $this->getCount(), PDO::PARAM_INT);
        } else {
            $query = 'SELECT * FROM `publication` WHERE `published` = :p LIMIT :off, :lim';
            $statement = $this->_conn->prepare($query);
            $statement->bindParam(':p', $published, PDO::PARAM_BOOL);
            $statement->bindParam(':off', $offset, PDO::PARAM_INT);
            $statement->bindParam(':lim', $limit, PDO::PARAM_INT);
        }

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getListByThemeIdPublished(
        $themeId,
        $published = true,
        $offset = null,
        $limit = null
    ) {
        if (!isset($offset) && !isset($limit)) {
            $query =
                'SELECT * FROM `publication` ' .
                'WHERE `theme_id` = :tid AND `published` = :p';

            $statement = $this->_conn->prepare($query);

            $statement->bindParam(':tid', $themeId, PDO::PARAM_INT);
            $statement->bindParam(':p', $published, PDO::PARAM_BOOL);

        } elseif (!isset($offset) && isset($limit)) {
            $query =
                'SELECT * FROM `publication` ' .
                'WHERE `theme_id` = :tid AND `published` = :p LIMIT :lim';

            $statement = $this->_conn->prepare($query);

            $statement->bindParam(':tid', $themeId, PDO::PARAM_INT);
            $statement->bindParam(':p', $published, PDO::PARAM_BOOL);
            $statement->bindParam(':lim', $limit, PDO::PARAM_INT);

        } elseif (isset($offset) && !isset($limit)) {
            $query =
                'SELECT * FROM `publication` ' .
                'WHERE `theme_id` = :tid AND `published` = :p LIMIT :off, :lim';

            $statement = $this->_conn->prepare($query);

            $statement->bindParam(':tid', $themeId, PDO::PARAM_INT);
            $statement->bindParam(':p', $published, PDO::PARAM_BOOL);
            $statement->bindParam(':off', $offset, PDO::PARAM_INT);
            $statement->bindValue(':lim', (int) $this->getCount(), PDO::PARAM_INT);

        } else {
            $query =
                'SELECT * FROM `publication` WHERE ' .
                '`theme_id` = :tid AND `published` = :p LIMIT :off, :lim';
            $statement = $this->_conn->prepare($query);

            $statement->bindParam(':tid', $themeId, PDO::PARAM_INT);
            $statement->bindParam(':p', $published, PDO::PARAM_BOOL);
            $statement->bindParam(':off', $offset, PDO::PARAM_INT);
            $statement->bindParam(':lim', $limit, PDO::PARAM_INT);
        }

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTitle($id)
    {
        $query = 'SELECT `title` FROM `publication` WHERE `id` = :id';
        $statement = $this->_conn->prepare($query);

        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_NUM)[0];
    }

    public function getContent($id)
    {
        $query = 'SELECT `content` FROM `publication` WHERE `id` = :id';
        $statement = $this->_conn->prepare($query);

        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_NUM)[0];
    }

    public function getDescription($id)
    {
        $query = 'SELECT `description` FROM `publication` WHERE `id` = :id';
        $statement = $this->_conn->prepare($query);

        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_NUM)[0];
    }

    public function getThemeId($id)
    {
        $query = 'SELECT `theme_id` FROM `publication` WHERE `id` = :id';
        $statement = $this->_conn->prepare($query);

        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_NUM)[0];
    }

    public function isPublished($id)
    {
        $query = 'SELECT `published` FROM `publication` WHERE `id` = :id';
        $statement = $this->_conn->prepare($query);

        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_NUM)[0];
    }

    // Update-methods

    public function setTitle($id, $title)
    {
        $query = 'UPDATE `publication` SET `title` = :new_t WHERE `id` = :id';
        $statement = $this->_conn->prepare($query);

        $statement->bindParam(':new_t', $title, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        return $statement->execute();
    }

    public function setContent ($id, $content)
    {
        $query = 'UPDATE `publication` SET `content` = :new_c WHERE `id` = :id';
        $statement = $this->_conn->prepare($query);

        $statement->bindParam(':new_c', $content, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        return $statement->execute();
    }

    public function setDescription($id, $description)
    {
        $query = 'UPDATE `publication` SET `description` = :new_d WHERE `id` = :id';
        $statement = $this->_conn->prepare($query);

        $statement->bindParam(':new_d', $description, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        return $statement->execute();
    }

    public function setThemeId($id, $theme_id)
    {
        $query = 'UPDATE `publication` SET `theme_id` = :new_ti WHERE `id` = :id';
        $statement = $this->_conn->prepare($query);

        $statement->bindParam(':new_ti', $theme_id, PDO::PARAM_INT);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        return $statement->execute();
    }

    public function setPublished($id, $published)
    {
        $query = 'UPDATE `publication` SET `published` = :new_p WHERE `id` = :id';
        $statement = $this->_conn->prepare($query);

        $statement->bindParam(':new_p', $published, PDO::PARAM_BOOL);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        return $statement->execute();
    }
}
