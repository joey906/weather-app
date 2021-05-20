<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
            'name' => 'joey',
            'pass' => 'joey',
            'email' => 'jtf1owataeba2ymi@gmail.com',
            'pref' => '東京都'
            ],
            [
            'name' => 'maria',
            'pass' => 'maria',
            'email' => 'maria@gmail.com',
            'pref' => '静岡'
            ]
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
