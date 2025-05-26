<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use App\Services\TaskService;
use Inertia\Inertia;
use Inertia\Response;

class TaskController extends Controller
{
    protected $serviceTask;

    public function __construct(TaskService $serviceTask)
    {
        $this->serviceTask = $serviceTask;
    }

    public function index(): Response
    {
        return Inertia::render('Tasks/List');
    }

    public function list()
    {
        return  $this->serviceTask->list();
    }

    public function store(TaskRequest $request)
    {
        $task = Task::create($request);

        return response()->json($task, 201);
    }

    public function show($id)
    {
        return Inertia::render('Tasks/Cadastro');
    }
    
    public function update(TaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);

        $validated = $request->validate([
            'titulo' => 'sometimes|required|string|max:255',
            'descricao' => 'nullable|string',
            'status' => 'sometimes|required|in:pendente,concluida',
        ]);

        $task->update($validated);

        return response()->json($task);
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(['message' => 'Task deletada com sucesso.']);
    }
}
