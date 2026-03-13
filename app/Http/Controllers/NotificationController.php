<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * عرض جميع الإشعارات
     */
    public function index()
    {
        $notifications = Auth::user()->notifications()
            ->with(['notifiable'])
            ->latest()
            ->paginate(20);
            
        return view('notifications.index', compact('notifications'));
    }

    /**
     * تحديد جميع الإشعارات كمقروءة
     */
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        
        return redirect()->back()
            ->with('success', 'تم تحديد جميع الإشعارات كمقروءة');
    }

    /**
     * تحديد إشعار معين كمقروء
     */
    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        
        return redirect()->back();
    }

    /**
     * حذف إشعار
     */
    public function destroy($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->delete();
        
        return redirect()->back()
            ->with('success', 'تم حذف الإشعار');
    }

    /**
     * حذف جميع الإشعارات
     */
    public function destroyAll()
    {
        Auth::user()->notifications()->delete();
        
        return redirect()->back()
            ->with('success', 'تم حذف جميع الإشعارات');
    }

    /**
     * الحصول على عدد الإشعارات غير المقروءة
     */
    public function getUnreadCount()
    {
        $count = Auth::user()->unreadNotifications->count();
        
        return response()->json(['count' => $count]);
    }
}
