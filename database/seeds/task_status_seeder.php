<?php

use Illuminate\Database\Seeder;
use App\Models\taskStatusModel;

class task_status_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        taskStatusModel::create([
            'status_name' => 'Aberta'
        ]);
        taskStatusModel::create([
            'status_name' => 'Em Desenvolvimento'
        ]);
        taskStatusModel::create([
            'status_name' => 'Concluida'
        ]);
        taskStatusModel::create([
            'status_name' => 'Em atraso'
        ]);
    }
}
