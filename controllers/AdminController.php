<?php

require_once ROOT . '/controllers/Controller.php';
require_once ROOT . '/models/AdminConfigModel.php';

class AdminController extends Controller
{
    private $_adminConfigModel;

    public function __construct()
    {
        parent::__construct();

        $this->_adminConfigModel = new AdminConfigModel();
    }

    public function actionIndex()
    {
        self::actionMain();
    }

    public function actionMain()
    {
        $adminLogin = $this->_adminConfigModel->getLogin();
        $adminPassword = $this->_adminConfigModel->getPassword();

        // проверка, есть ли в бд информация об администраторе
        if ($adminLogin !== null and $adminPassword !== null) {
            // если у сайта есть администратор, то тогда проверяем куки
            // у пользователя
            $login = Application::getSiteCookie('login');
            $password = Application::getSiteCookie('password');

            // в куках должна быть информация о логине и пароле
            // если она присутствует...
            if ($login !== null or $password !== null) {
                // ...то сравниваем эту информацию
                if ($login === $adminLogin and $password === $adminPassword) {
                    // если совпадает, то вход выполнен
                    echo 'вход выполнен!';
                } else {
                    // в противном случае либо данных в куках не хранится,
                    // либо они повреждены. удаляем их за ненадобностью
                    Application::eatCookie('login');
                    Application::eatCookie('password');

                    echo 'выполните вход';
                }
            } else {
                // в противном случае либо данных в куках не хранится,
                // либо они повреждены. удаляем их за ненадобностью
                Application::eatCookie('login');
                Application::eatCookie('password');

                echo 'выполните вход';
            }
        } else {
            Application::eatCookie('login');
            Application::eatCookie('password');

            include ROOT . '/views/admin/create-admin.php';
        }

//        include ROOT . '/views/admin/main.php';
    }
}
