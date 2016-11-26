<?php

require_once ROOT . '/controllers/Controller.php';
require_once ROOT . '/models/PublicationModel.php';

class PublicationController extends Controller
{
    private $_publicationsPerPage;

    // models
    private $_publicationModel;

    public function __construct()
    {
        parent::__construct();

        $this->_publicationsPerPage = 3;
        $this->_publicationModel = new PublicationModel();
        $this->_defaultActionArgs = [1];
    }

    public function actionIndex()
    {
        self::actionShowAll(1);
    }

    public function actionShowAll($page = 1)
    {
        $publications = $this->_publicationModel->getListPublished();

        echo '<pre>';
        var_dump($publications);
        echo '</pre>';
    }
}
