<?php
namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    public static function add($role, $pelanggan_id, $title, $message, $location)
    {
        $notification = new Notification();
        $notification->pelanggan_id = $pelanggan_id;
        $notification->role = $role;
        $notification->title = $title;
        $notification->message = $message;
        $notification->location = $location;
        $notification->save();
    }

    public static function getNotify($pelangganId = null)
    {
        if ($pelangganId != null)
            $notification = Notification::where('pelanggan_id', $pelangganId)->where('role', 'pelanggan')->where('is_read', false)->get();
        else
            $notification = Notification::where('role', 'admin')->where('is_read', false)->get();
        return $notification;
    }

    public static function isTerlambatNotify($pelangganId, $rentalId)
    {
        $notification = Notification::where('pelanggan_id', $pelangganId)->where('role', 'pelanggan')->where('title', 'Terlambat')->where('message', 'Rental dengan ' . $rentalId . ' telah terlambat')->first();
        if ($notification != null)
            return true;
        else
            return false;
    }

    public static function isRead($id)
    {
        $notification = Notification::find($id);
        $notification->is_read = true;
        $notification->save();
        return $notification->location;
    }
}