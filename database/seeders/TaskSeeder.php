<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_id = User::all(['id'])->random()->id;
        DB::table('tasks')->insert([
            'title' => Str::random(10),
            'description' => Str::random(20),
            'user_id' => $user_id,
        ]);
    }
}
