<?php
declare(strict_types=1);

namespace Lovesafe\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'password_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'name' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => 'Имя (псевдоним)', 'precision' => null],
        'sex' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => 'Пол', 'precision' => null],
        'birthday' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => 'Дата рождения.', 'precision' => null],
        'town' => ['type' => 'integer', 'length' => 9, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'Код города.', 'precision' => null, 'autoIncrement' => null],
        'height' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'Рост в см.', 'precision' => null, 'autoIncrement' => null],
        'weight' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'Вес в кг.', 'precision' => null, 'autoIncrement' => null],
        'constitution' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => 'нет ответа', 'collate' => 'utf8mb4_general_ci', 'comment' => 'Телосложение', 'precision' => null],
        'eyecolor' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => 'нет ответа', 'collate' => 'utf8mb4_general_ci', 'comment' => 'Цвет глаз', 'precision' => null],
        'haircolor' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => 'нет ответа', 'collate' => 'utf8mb4_general_ci', 'comment' => 'Цвет волос', 'precision' => null],
        'onbody' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => 'На вашем теле есть', 'precision' => null],
        'relationship' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => 'нет ответа', 'collate' => 'utf8mb4_general_ci', 'comment' => 'Отношения', 'precision' => null],
        'children' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => 'нет ответа', 'collate' => 'utf8mb4_general_ci', 'comment' => 'Дети', 'precision' => null],
        'housing' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => 'нет ответа', 'collate' => 'utf8mb4_general_ci', 'comment' => 'Жилищные условия', 'precision' => null],
        'car' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => 'нет ответа', 'collate' => 'utf8mb4_general_ci', 'comment' => 'Наличие автомобиля', 'precision' => null],
        'ilooking' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => 'Я ищу', 'precision' => null],
        'myincome' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => 'нет ответа', 'collate' => 'utf8mb4_general_ci', 'comment' => 'Доход', 'precision' => null],
        'education' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => 'нет ответа', 'collate' => 'utf8mb4_general_ci', 'comment' => 'Образование', 'precision' => null],
        'fieldactivity' => ['type' => 'text', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => 'Сфера деятельности.', 'precision' => null],
        'smoking' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => 'нет ответа', 'collate' => 'utf8mb4_general_ci', 'comment' => 'Курение', 'precision' => null],
        'alcohol' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => 'Алкоголь', 'precision' => null],
        'aboutyouself' => ['type' => 'text', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => 'Коротко о себе.', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => 'Время создания записи.'],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => 'Время изменения записи.'],
        '_indexes' => [
            'password_id' => ['type' => 'index', 'columns' => ['password_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'users_ibfk_1' => ['type' => 'foreign', 'columns' => ['password_id'], 'references' => ['passwords', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'password_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'sex' => 'Lorem ipsum dolor sit amet',
                'birthday' => '2020-10-11',
                'town' => 1,
                'height' => 1,
                'weight' => 1,
                'constitution' => 'Lorem ipsum dolor sit amet',
                'eyecolor' => 'Lorem ipsum dolor sit amet',
                'haircolor' => 'Lorem ipsum dolor sit amet',
                'onbody' => 'Lorem ipsum dolor sit amet',
                'relationship' => 'Lorem ipsum dolor sit amet',
                'children' => 'Lorem ipsum dolor sit amet',
                'housing' => 'Lorem ipsum dolor sit amet',
                'car' => 'Lorem ipsum dolor sit amet',
                'ilooking' => 'Lorem ipsum dolor sit amet',
                'myincome' => 'Lorem ipsum dolor sit amet',
                'education' => 'Lorem ipsum dolor sit amet',
                'fieldactivity' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'smoking' => 'Lorem ipsum dolor sit amet',
                'alcohol' => 'Lorem ipsum dolor sit amet',
                'aboutyouself' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'created' => '2020-10-11 14:32:40',
                'modified' => '2020-10-11 14:32:40',
            ],
        ];
        parent::init();
    }
}
