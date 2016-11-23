<?php

require_once ROOT.'/models/Model.php';

class PublicationModel extends Model
{
	public function createPublication($title, $content, $description, $theme_id, $published)
	{
		$query = 'INSERT INTO `publication` (`title`, `content`,`description`, `theme_id`, `published`) VALUES (:title, :content, :description, :theme_id, :published)';
		$statement = $this->_conn->prepare($query, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
		
		$statement->execute([
			'title' => $title,
			'content' => $content,
			'description' => $description,
			'theme_id' => $theme_id,
			'published' => $published
		]);
	}
	
	public function getTheme ($id) {
		$query = 'SELECT `theme_id` FROM `publication` WHERE `id`=:id';
		$statement = $this->_conn->prepare($query);

        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_NUM)[0];
	}	
	
	public function getTitle ($id) {
		$query = 'SELECT `title` FROM `publication` WHERE `id`=:id';
		$statement = $this->_conn->prepare($query);

        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_NUM)[0];
	}	
	
	public function getContent ($id) {
		$query = 'SELECT `content` FROM `publication` WHERE `id`=:id';
		$statement = $this->_conn->prepare($query);

        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_NUM)[0];
	}	
	
	public function getDescription ($id) {
		$query = 'SELECT `description` FROM `publication` WHERE `id`=:id';
		$statement = $this->_conn->prepare($query);

        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_NUM)[0];
	}	
	
	public function getIsPublished ($id) {
		$query = 'SELECT `published` FROM `publication` WHERE `id`=:id';
		$statement = $this->_conn->prepare($query);

        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_NUM)[0];
	}
	
	public function setTitle ($id, $title) {
		$query = 'UPDATE `publication` SET `title`=:new_t WHERE `id`=:id';
		$statement = $this->_conn->prepare($query);

        $statement->bindParam(':new_t', $title, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        return $statement->execute();
	}
	
	public function setDescription ($id, $desc) {
		$query = 'UPDATE `publication` SET `description`=:new_d WHERE `id`=:id';
		$statement = $this->_conn->prepare($query);

        $statement->bindParam(':new_d', $desc, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        return $statement->execute();		
	}
	
	public function setContent ($id, $content) {
		$query = 'UPDATE `publication` SET `content`=:new_c WHERE `id`=:id';
		$statement = $this->_conn->prepare($query);

        $statement->bindParam(':new_c', $content, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        return $statement->execute();		
	}
	
	public function setThemeId ($id, $theme_id) {
		$query = 'UPDATE `publication` SET `theme_id`=:new_ti WHERE `id`=:id';
		$statement = $this->_conn->prepare($query);

        $statement->bindParam(':new_ti', $theme_id, PDO::PARAM_INT);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        return $statement->execute();		
	}
	
	public function setThemeId ($id, $theme_id) {
		$query = 'UPDATE `publication` SET `theme_id`=:new_ti WHERE `id`=:id';
		$statement = $this->_conn->prepare($query);

        $statement->bindParam(':new_ti', $theme_id, PDO::PARAM_INT);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        return $statement->execute();		
	}
	
	public function setPublished ($id, $publ) {
		$query = 'UPDATE `publication` SET `published`=:new_p WHERE `id`=:id';
		$statement = $this->_conn->prepare($query);

        $statement->bindParam(':new_p', $publ, PDO::PARAM_BOOL);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        return $statement->execute();		
	}
}
