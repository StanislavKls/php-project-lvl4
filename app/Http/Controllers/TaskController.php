<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Label;
use App\Http\Requests\TaskRequest;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  use Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $statuses        = TaskStatus::all();
        $users           = User::all();
        $filter          = $request->filter;
        $currentStatus   = $filter ['status_id'] ?? '';
        $currentCreated  = $filter ['created_by_id'] ?? '';
        $currentAssigned = $filter ['assigned_to_id'] ?? '';
        $tasks    = QueryBuilder::for(Task::class)
                    ->allowedFilters([
                        AllowedFilter::exact('status_id'),
                        AllowedFilter::exact('created_by_id'),
                        AllowedFilter::exact('assigned_to_id'),
                    ])
                    ->get();
        
        return view('tasks.index', compact('tasks', 'statuses', 'users', 'currentStatus', 'currentCreated', 'currentAssigned'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $task     = new Task();
        $statuses = TaskStatus::all();
        $users    = User::all();
        $labels   = Label::all();
        return view('tasks.create', compact('task', 'statuses', 'users', 'labels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\TaskRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TaskRequest $request)
    {
        $data = $request->validated();
        $task = new Task();
        $task->fill($data);
        $task->save();
        $task->labels()->sync($request->labels);
        flash('Задача добавлена!')->success();
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\View\View
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\View\View
     */
    public function edit(Task $task)
    {
        $statuses     = TaskStatus::all();
        $users        = User::all();
        $labels       = Label::all();
        $lablesOfTask = $task->labels->pluck('name');
        return view('tasks.edit', compact('task', 'statuses', 'users', 'labels', 'lablesOfTask'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\TaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TaskRequest $request, Task $task)
    {
        $data = $request->validated();
        $task->fill($data);
        $task->save();
        $task->labels()->sync($request->labels);
        flash('Задача изменена!')->success();
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task)
    {
        $task->delete();
        flash('Задача удалена')->success();
        return redirect()->route('tasks.index');
    }
}
