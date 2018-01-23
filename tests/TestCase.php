<?php

use \Illuminate\Database\Capsule\Manager as DB;

abstract class TestCase extends PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        $this->setUpDatabase();
        $this->migrateTables();
        parent::setUp();
    }

    protected function setUpDatabase()
    {
        $database = new DB;

        $database->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $database->bootEloquent();
        $database->setAsGlobal();
    }

    protected function migrateTables()
    {
        DB::schema()->create('posts', function($table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });
    }

    protected function makePost()
    {
        $post = new Post;
        $post->title = 'Some Title';
        $post->save();

        return $post;
    }
}

class Post extends \Illuminate\Database\Eloquent\Model
{
    use Dolly\Cacheable;
}