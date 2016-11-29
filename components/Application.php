<?php

require_once ROOT . '/components/Router.php';
require_once ROOT . '/components/exceptions/FileNotFoundException.php';
require_once ROOT . '/components/exceptions/InvalidNameException.php';

class Application
{
    const COOKIE_EXPIRE_SESSION = null;
    const COOKIE_EXPIRE_YEAR = 60 * 60 * 24 * 365;
    const SITE_STYLES = '/resources/css/styles.css';
    const SITE_FONTS =
        'https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,' .
        '400i,500,500i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,latin-ext';

    public static $config;

    private $_router;
    private $_controller;
    private $_action;
    private $_actionArgs;

    public function __construct(&$config)
    {
        self::$config = $config;
    }

    public function run()
    {
        try {
            $this->_router = new Router();
        } catch (FileNotFoundException $e) {
            // 404
            echo '404 file not found'; die;
        } catch (InvalidNameException $e) {
            // 404
            echo '404'; die;
        }

        $this->_controller = $this->_router->getController();
        $this->_action = $this->_router->getActionName();
        $this->_actionArgs = $this->_router->getActionArgs();

        if (!method_exists($this->_controller, $this->_action)) {
            // 404
            echo '404'; die;
        }

        if (
            count($this->_actionArgs) != (new ReflectionMethod(
                $this->_controller,
                $this->_action)
            )->getNumberOfParameters()
        ) {
            // 404
            echo '404'; die;
        }

        return call_user_func_array(
            [
                $this->_controller,
                $this->_action
            ],
            $this->_actionArgs
        );
    }

    public static function encryptCookie($value)
    {
        if (!$value) {
            return false;
        }

        $ivSize = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($ivSize, MCRYPT_RAND);

        $cryptText = mcrypt_encrypt(
            MCRYPT_RIJNDAEL_256,
            md5(self::$config['app']['cookieKey']),
            $value,
            MCRYPT_MODE_ECB,
            $iv
        );

        return trim(base64_encode($cryptText));
    }

    public static function decryptCookie($value)
    {
        if (!$value) {
            return false;
        }

        $cryptText = base64_decode($value);
        $ivSize = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($ivSize, MCRYPT_RAND);

        $decryptText = mcrypt_decrypt(
            MCRYPT_RIJNDAEL_256,
            md5(self::$config['app']['cookieKey']),
            $cryptText,
            MCRYPT_MODE_ECB,
            $iv
        );

        return trim($decryptText);
    }

    public static function setSiteCookie(
        string $name, $value, $expire = self::COOKIE_EXPIRE_SESSION
    ) {
        setcookie($name, self::encryptCookie($value), time() + $expire);
    }

    public static function getSiteCookie(string $name)
    {
        return $_COOKIE[$name] ?? null;
    }

    public static function eatCookie(string $name)
    {
        self::setSiteCookie($name, null);
    }

    public static function passwordHashCode(string $password) : string
    {
        return md5(
            self::$config['app']['passwordLeftSalt'] .
            $password .
            self::$config['app']['passwordRightSalt']
        );
    }
}
