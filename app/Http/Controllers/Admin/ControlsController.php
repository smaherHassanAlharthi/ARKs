<?php

namespace App\Http\Controllers\Admin;

use App\Control;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreControlsRequest;
use App\Http\Requests\Admin\UpdateControlsRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class ControlsController extends Controller
{
    /**
     * Display a listing of Control.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('control_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Control.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Control.filter', 'my');
            }
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('control_delete')) {
                return abort(401);
            }
            $controls = Control::onlyTrashed()->get();
        } else {
            $controls = Control::all();
        }

        return view('admin.controls.index', compact('controls'));
    }

    /**
     * Show the form for creating new Control.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('control_create')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.controls.create', compact('created_bies'));
    }

    /**
     * Store a newly created Control in storage.
     *
     * @param  \App\Http\Requests\StoreControlsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreControlsRequest $request)
    {
        if (! Gate::allows('control_create')) {
            return abort(401);
        }
        $control = Control::create($request->all());



        return redirect()->route('admin.controls.index');
    }


    /**
     * Show the form for editing Control.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('control_edit')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $control = Control::findOrFail($id);

        return view('admin.controls.edit', compact('control', 'created_bies'));
    }

    /**
     * Update Control in storage.
     *
     * @param  \App\Http\Requests\UpdateControlsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateControlsRequest $request, $id)
    {
        if (! Gate::allows('control_edit')) {
            return abort(401);
        }
        $control = Control::findOrFail($id);
        $control->update($request->all());



        return redirect()->route('admin.controls.index');
    }


    /**
     * Display Control.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('control_view')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$alerts = \App\Alert::where('controller_id', $id)->get();$consumptions = \App\Consumption::where('control_id', $id)->get();

        $control = Control::findOrFail($id);

        return view('admin.controls.show', compact('control', 'alerts', 'consumptions'));
    }


    /**
     * Remove Control from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('control_delete')) {
            return abort(401);
        }
        $control = Control::findOrFail($id);
        $control->delete();

        return redirect()->route('admin.controls.index');
    }

    /**
     * Delete all selected Control at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('control_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Control::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Control from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('control_delete')) {
            return abort(401);
        }
        $control = Control::onlyTrashed()->findOrFail($id);
        $control->restore();

        return redirect()->route('admin.controls.index');
    }

    /**
     * Permanently delete Control from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('control_delete')) {
            return abort(401);
        }
        $control = Control::onlyTrashed()->findOrFail($id);
        $control->forceDelete();

        return redirect()->route('admin.controls.index');
    }
}
