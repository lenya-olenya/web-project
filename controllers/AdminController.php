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
        $loginFromDb = $this->_adminConfigModel->getLogin();
        $passwordFromDb = $this->_adminConfigModel->getPassword();

        // проверка, есть ли в бд информация об администраторе
        if (isset($loginFromDb) and isset($passwordFromDb)) {
            // если у сайта есть администратор, то тогда проверяем куки
            // у пользователя
            $loginFromCookie = Application::getSiteCookie('login');
            $passwordFromCookie = Application::getSiteCookie('password');

            // в куках должна быть информация о логине и пароле
            // если она присутствует в браузере пользователя
            // и совпадает с данными из базы...
            if (
                isset($loginFromCookie) and
                isset($passwordFromCookie) and
                $loginFromCookie === $loginFromDb and
                $passwordFromCookie === $passwordFromDb
            ) {
                // ...то вход на сайт выполнен
                include ROOT . '/views/admin/main.php';
            } else {
                // в противном случае либо данных в куках не хранится,
                // либо они неверные. удаляем их за ненадобностью
                Application::eatCookie('login');
                Application::eatCookie('password');

                // возможно, пользователь прислал данные на вход
                // проверим их
                $loginFromRequest = $_REQUEST['login'] ?? null;
                $passwordFromRequest = isset($_REQUEST['password']) ? Application::passwordHashCode($_REQUEST['password']) : null;

                if (
                    isset($loginFromRequest) and
                    isset($passwordFromRequest) and
                    $loginFromRequest === $loginFromDb and
                    $passwordFromRequest === $passwordFromDb
                ) {
                    Application::setSiteCookie('login', $loginFromRequest);
                    Application::setSiteCookie('password', $passwordFromRequest);

                    include ROOT . '/views/admin/main.php';
                } else {
                    // в противном случае предлагаем войти на сайт
                    include ROOT . '/views/admin/sign-in-admin.php';
                }
            }
        } elseif (  // у сайта нет администратора - проверяем, передали ли нам параметры
            isset($_REQUEST['login']) &&
            isset($_REQUEST['password']) &&
            isset($_REQUEST['confirmPassword'])
        ) {
            $loginFromCookie = $_REQUEST['login'];
            $passwordFromCookie = $_REQUEST['password'];
            $confirmPassword = $_REQUEST['confirmPassword'];
            $errors = [];

            if (!self::_isValidLogin($loginFromCookie)) {
                $errors[] = 'Неправильно составлен логин';
            }

            if (!self::_isValidPassword($passwordFromCookie)) {
                $errors[] = 'Неправильно составлен пароль';
            }

            if ($passwordFromCookie !== $confirmPassword) {
                $errors[] = 'Пароли не совпадают';
            }

            if (count($errors) == 0) {
                $this->_adminConfigModel->setLogin($loginFromCookie);
                $this->_adminConfigModel->setPassword(Application::passwordHashCode($passwordFromCookie));

                Application::setSiteCookie('login', $loginFromCookie);
                Application::setSiteCookie('password', Application::passwordHashCode($passwordFromCookie));

                include ROOT . '/views/admin/main.php';
            } else {
                include ROOT . '/views/admin/create-admin.php';
            }
        } else {    // нет параметров - предлагаем создать нового пользователя
                    // предварительно почистив старые куки
            Application::eatCookie('login');
            Application::eatCookie('password');

            include ROOT . '/views/admin/create-admin.php';
        }
    }

    private static function _isValidLogin($login) {
        return preg_match('/[a-zA-Z\d\s-_]{4,32}/', $login);
    }

    private static function _isValidPassword($password) {
        return preg_match(
            '/[a-zA-Z\d\s]{8,32}/',
            $password
        );
    }
}
