<?php

namespace App\Http\Controllers\Admin;

use App\Subscriber;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriberController extends Controller
{

    public function index(){

        $subscribes = Subscriber::latest()->get();
        return view('admin.subscriber', compact('subscribes'));
    }

    public function destroy($subscriber){

        $subscriber = Subscriber::findOrFail($subscriber);
        $subscriber->delete();

        Toastr::success('la newsletter a bien été supprimer', 'success');
        return redirect()->back();
    }
}
