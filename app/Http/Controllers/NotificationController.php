<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('pelanggan')->check()) {
            $notifications = NotificationService::getNotify(Auth::guard('pelanggan')->user()->id);
        } else {
            $notifications = NotificationService::getNotify();
        }

        return View::make('layouts.notification', compact('notifications'));
    }


    public function show($id)
    {
        $notification = NotificationService::isRead($id);

        return redirect($notification);
    }

}