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
        try {
            if (Auth::guard('pelanggan')->check()) {
                $notifications = NotificationService::getNotify(Auth::guard('pelanggan')->user()->id);
            } else {
                $notifications = NotificationService::getNotify();
            }
            $html = View::make('layouts.notification', compact('notifications'));
            return response([
                'message' => 'success',
                'data' => [
                    'count' => $notifications->count(),
                    'html' => $html->render()
                ]
            ], 200);
            // return View::make('layouts.notification', compact('notifications'));
        } catch (\Throwable $th) {
            return response([
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function show($id)
    {
        $notification = NotificationService::isRead($id);

        return redirect($notification);
    }

}