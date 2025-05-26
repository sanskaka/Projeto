<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function list()
    {
        return Task::all();
    }
}