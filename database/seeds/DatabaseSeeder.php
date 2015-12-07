<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create a user
        DB::table('users')->insert([
            'name' => 'arabyalhomsi',
            'email' => 'araby.ami@gmail.com',
            'password' => Hash::make('aaa123')
        ]);

        // create a user
        DB::table('users')->insert([
            'name' => 'ameralhomsi',
            'email' => 'arabyalhomsi@gmail.com',
            'password' => Hash::make('aaa123')
        ]);

        // create a category
        App\Category::create([
            'title' => 'love'
        ]);

        App\Category::create([
            'title' => 'dance'
        ]);
        // create an article
        $article = new App\Article([
            'title' => 'arabylaohmsiasdas',
            'body' => 'BlAb ABlAb AbBlAb Ab BlAb Abb',
            'views' => 20
        ]);
        $article2 = new App\Article([
            'title' => 'basdasd',
            'body' => 'BlAb ABlAb asdasdasAbBlAb Ab BlAb Abb',
            'views' => 30
        ]);

        App\User::all()[0]->articles()->save($article);
        App\Category::all()[0]->articles()->save($article);
        App\Category::all()[1]->articles()->save($article);

        App\User::all()[0]->articles()->save($article2);
        App\Category::all()[0]->articles()->save($article2);
        App\Category::all()[1]->articles()->save($article2);
    }
}
