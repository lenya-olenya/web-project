<?php

require_once ROOT . '/controllers/Controller.php';
require_once ROOT . '/models/PublicationModel.php';
require_once ROOT . '/models/ThemeModel.php';

class PublicationController extends Controller
{
    private $_publicationsPerPage;

    // models
    private $_publicationModel;
    private $_themeModel;

    public function __construct()
    {
        parent::__construct();

        $this->_publicationsPerPage = 8;
        $this->_publicationModel = new PublicationModel();
        $this->_themeModel = new ThemeModel();
    }

    public function actionIndex()
    {
        self::actionShowAll();
    }

    public function actionShowAll($page = 1)
    {
        $publications = $this->_publicationModel->getListPublished(
            true,
            ($page - 1) * $this->_publicationsPerPage,
            $page * $this->_publicationsPerPage
        );

        include ROOT . '/views/publication/show-all.php';
    }

    public function actionShowTheme($themeId, $page = 1) {
        $publications = $this->_publicationModel->getListByThemeIdPublished(
            $themeId, true,
            ($page - 1) * $this->_publicationsPerPage,
            $page * $this->_publicationsPerPage
        );

        include ROOT . '/views/publication/show-theme.php';
    }

    public function actionShow($publicationId)
    {
        $p = $this->_publicationModel->get($publicationId);

        include ROOT . '/views/publication/show.php';
    }
}
