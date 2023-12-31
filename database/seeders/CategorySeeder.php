<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $category = new Category();
        $category->title = 'Main Support';
        $category->type = 'ticket';
        $category->language = 'en';
        $category->save();

        $category = new Category();
        $category->title = 'News';
        $category->type = 'article';
        $category->language = 'en';
        $category->save();

        $category = new Category();
        $category->title = 'Deposit';
        $category->type = 'deposit';
        $category->language = 'en';
        $category->save();

        $category = new Category();
        $category->title = 'Withdraw';
        $category->type = 'withdraw';
        $category->language = 'en';
        $category->save();
    }
}
