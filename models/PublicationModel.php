<?php

require_once ROOT.'/models/Model.php';

class PublicationModel extends Model
{
	public function createPublication($title, $content, $description, $theme_id, $published)
	{
		$query = 'INSERT INTO `publication` (`title`, `content`,`decription`, `theme_id`, `published`) VALUES (:title, :content, :description, :theme_id, :published)';
		$statement = $this->_conn->prepare($query, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
		
		$statement->execute([
			'title' => $title,
			'content' => $content,
			'description' => $description,
			'theme_id' => $theme_id,
			'published' => $published
		]);
	}
}
