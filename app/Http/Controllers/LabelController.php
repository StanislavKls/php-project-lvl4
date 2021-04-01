<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Http\Requests\LabelRequest;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $labels = Label::paginate();
        $label = $labels->first();
        //dd($label->tasks);
        return view('labels.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $label = new Label();
        return view('labels.create', compact('label'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\LabelRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LabelRequest $request)
    {
        $data = $request->validated();
        $label = new Label();
        $label->fill($data);
        $label->save();
        flash('Метка добавлена!')->success();
        return redirect()->route('labels.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\View\View
     */
    public function edit(Label $label)
    {
        return view('labels.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\LabelRequest  $request
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(LabelRequest $request, Label $label)
    {
        $data = $request->validated();
        $label->fill($data);
        $label->save();
        flash('Метка изменена!')->success();
        return redirect()->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Label $label)
    {
        if (count($label->tasks) > 0) {
            flash('Не удалось удалить метку')->error();
            return redirect()->route('labels.index');
        }
        $label->delete();
        flash('Метка удалена')->success();
        return redirect()->route('labels.index');
    }
}
