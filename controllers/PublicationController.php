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
    }

    public function actionIndex()
    {
        self::actionShowAll();
    }

    public function actionShowAll($page = 1)
    {
        $publications = $this->_publicationModel->getListPublished();

        include ROOT . '/views/publication/show-all.php';
    }

    public function actionShow($publicationId)
    {
        $p = $this->_publicationModel->get($publicationId);

        include ROOT . '/views/publication/show.php';
    }
}
