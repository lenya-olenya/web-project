<?php

require_once ROOT . '/models/ThemeModel.php';

class Application
{
    public static $config;

    public function __construct(&$config)
    {
        self::$config = $config;
    }

    public function run()
    {
        // тесты модели

        $model = new ThemeModel();

        $ids = [
            $model->add('Test Theme 1', 'Test Description 1'),
            $model->add('Test Theme 2', 'Test Description 2', true),
            $model->add('Test Theme 3', 'Test Description 3'),
            $model->add('Test Theme 4', 'Test Description 4', true),
            $model->add('Test Theme 5', 'Test Description 5'),
            $model->add('Test Theme 6', 'Test Description 6', true),
            $model->add('Test Theme 7', 'Test Description 7'),
            $model->add('Test Theme 8', 'Test Description 8', true),
            $model->add('Test Theme 9', 'Test Description 9'),
            $model->add('Test Theme 10', 'Test Description 10', true),
        ];

        var_dump($ids);

        //

        echo '<h3>Получение количества записей</h3>';
        var_dump($model->getCount());

        //

        echo '<h3>Обращение к конкретной строке</h3>';
        var_dump($model->get($ids[5]));

        //

        echo '<h3>Вывод списка</h3>';

        echo '<h4>Полностью</h4>';
        var_dump($model->getList());

        echo '<h4>Вывод, начиная с i, n элементов</h4>';
        var_dump($model->getList(2, 5));

        echo '<h4>Вывод, начиная с i, всех элементов</h4>';
        var_dump($model->getList(2));

        echo '<h4>Вывод, начиная с начала, n элементов</h4>';
        var_dump($model->getList(5));

        //

        echo '<h4>Удаление</h4>';

        foreach ($ids as $id) {
            $model->delete($id);
        }

        echo 'passed';
    }
}
