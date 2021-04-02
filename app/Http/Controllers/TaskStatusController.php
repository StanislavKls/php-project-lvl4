<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStatusesRequest;
use App\Models\TaskStatus;

class TaskStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $statuses = TaskStatus::paginate();
        return view('task_statuses.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $status = new TaskStatus();
        return view('task_statuses.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\TaskStatusesRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TaskStatusesRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $status = new TaskStatus();
        $status->fill($data);
        $status->save();
        flash('Статус успешно создан')->success();
        return redirect()->route('task_statuses.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return \Illuminate\View\View
     */
    public function edit(TaskStatus $taskStatus)
    {
        return view('task_statuses.edit', compact('taskStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\TaskStatusesRequest  $request
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TaskStatusesRequest $request, TaskStatus $taskStatus)
    {
        $data = $request->validated();
        $taskStatus->fill($data);
        $taskStatus->save();
        flash('Статус успешно изменён')->success();
        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(TaskStatus $taskStatus)
    {
        if (count($taskStatus->task) > 0) {
            flash('Не удалось удалить статус')->error();
            return redirect()->route('task_statuses.index');
        }
        $taskStatus->delete();
        flash('Статус успешно удалён')->success();
        return redirect()->route('task_statuses.index');
    }
}
