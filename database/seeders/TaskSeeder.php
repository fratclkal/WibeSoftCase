<?php

namespace Database\Seeders;

use App\Models\TaskModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TaskModel::create([
            'title' => 'Task 1',
            'email' => 'kullanici1@example.com',
            'subject' => 'Subject 1',
            'time' => now(),
            'status' => 1,
        ]);

        TaskModel::create([
            'title' => 'Task 2',
            'email' => 'kullanici2@example.com',
            'subject' => 'Subject 2',
            'time' => now(),
            'status' => 1,
        ]);

        TaskModel::create([
            'title' => 'Task 3',
            'email' => 'kullanici3@example.com',
            'subject' => 'Subject 3',
            'time' => now(),
            'status' => 0,
        ]);

        TaskModel::create([
            'title' => 'Task 4',
            'email' => 'kullanici4@example.com',
            'subject' => 'Subject 4',
            'time' => now(),
            'status' => 0,
        ]);

        TaskModel::create([
            'title' => 'Task 5',
            'email' => 'kullanici5@example.com',
            'subject' => 'Subject 5',
            'time' => now(),
            'status' => 0,
        ]);
    }
}
