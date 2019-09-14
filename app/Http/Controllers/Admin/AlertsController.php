<?php

namespace App\Http\Controllers\Admin;

use App\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAlertsRequest;
use App\Http\Requests\Admin\UpdateAlertsRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class AlertsController extends Controller
{
    /**
     * Display a listing of Alert.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
            $alerts = Alert::all();
        

        return view('admin.alerts.index', compact('alerts'));
    }

    /**
     * Show the form for creating new Alert.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('alert_create')) {
            return abort(401);
        }
        
        $controllers = \App\Control::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.alerts.create', compact('controllers', 'created_bies'));
    }

    /**
     * Store a newly created Alert in storage.
     *
     * @param  \App\Http\Requests\StoreAlertsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlertsRequest $request)
    {
        if (! Gate::allows('alert_create')) {
            return abort(401);
        }
        $alert = Alert::create($request->all());
        $basic  = new \Nexmo\Client\Credentials\Basic('dd1593ca', 'dJwLLRknxC9Z3dzZ');
        $client = new \Nexmo\Client($basic);
        
        $message = $client->message()->send([
                                            'to' => '966501500957',
                                            'from' => 'Nexmo',
                                            'text' => 'Hello from Nexmo'
                                            ]);
        


        return redirect()->route('admin.alerts.index');
    }


    /**
     * Show the form for editing Alert.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('alert_edit')) {
            return abort(401);
        }
        
        $controllers = \App\Control::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $alert = Alert::findOrFail($id);

        return view('admin.alerts.edit', compact('alert', 'controllers', 'created_bies'));
    }

    /**
     * Update Alert in storage.
     *
     * @param  \App\Http\Requests\UpdateAlertsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlertsRequest $request, $id)
    {
        if (! Gate::allows('alert_edit')) {
            return abort(401);
        }
        $alert = Alert::findOrFail($id);
        $alert->update($request->all());



        return redirect()->route('admin.alerts.index');
    }


    /**
     * Display Alert.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('alert_view')) {
            return abort(401);
        }
        $alert = Alert::findOrFail($id);

        return view('admin.alerts.show', compact('alert'));
    }


    /**
     * Remove Alert from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('alert_delete')) {
            return abort(401);
        }
        $alert = Alert::findOrFail($id);
        $alert->delete();

        return redirect()->route('admin.alerts.index');
    }

    /**
     * Delete all selected Alert at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('alert_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Alert::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Alert from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('alert_delete')) {
            return abort(401);
        }
        $alert = Alert::onlyTrashed()->findOrFail($id);
        $alert->restore();

        return redirect()->route('admin.alerts.index');
    }

    /**
     * Permanently delete Alert from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('alert_delete')) {
            return abort(401);
        }
        $alert = Alert::onlyTrashed()->findOrFail($id);
        $alert->forceDelete();

        return redirect()->route('admin.alerts.index');
    }
}
