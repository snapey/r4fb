<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class AlertSubscriptionsController extends Controller
{
    public function index()
    {

        return view('user.alertSubscriptions.index')
            ->with('alerts', Auth::user()->alerts)
            ->with('events', $this->getClassesList(app_path('Events')));
    }

    public function update(Request $request)
    {
        foreach($request->events as $eventname => $vias) {
            if(is_null($vias)) {
                Auth::user()->alerts()->where('event',$eventname)->delete();
            } else {
                Auth::user()->alerts()->updateOrCreate(['event'=>$eventname],['via'=>implode(',',array_keys($vias))]);
            }
        }

        Alert::success('Subscription settings saved');
        return back();
    }

    function getClassesList($dir)
    {
        $classes = File::allFiles($dir);
        foreach ($classes as $class) {
            $class = str_replace('.php','', $class->getBasename());
            $classFullname = 'App\\Events\\' . $class;
            $classlist[$class] = $classFullname::alertable();
        }

        return Arr::sort($classlist);
    }

}
