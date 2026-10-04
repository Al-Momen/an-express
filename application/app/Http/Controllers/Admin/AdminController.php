<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\CurlRequest;
use App\Models\AdminNotification;
use App\Models\BookingRequest;
use App\Models\Deposit;
use App\Models\PickupRequest;
use App\Models\QuoteRequest;
use App\Models\Subscriber;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserLogin;
use App\Models\Withdrawal;
use App\Models\SupportTicket;
use App\Rules\FileTypeValidate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function dashboard()
    {
        $pageTitle = 'Dashboard';

        // The courier site doesn't use the user/deposit/withdraw modules, so
        // the dashboard is built around the features it actually has:
        // pickup requests, quote requests, contact messages and subscribers.
        $widget = [];
        $widget['total_pickup']       = PickupRequest::count();
        $widget['pending_pickup']     = PickupRequest::pending()->count();
        $widget['total_quote']        = QuoteRequest::count();
        $widget['pending_quote']      = QuoteRequest::pending()->count();
        $widget['total_booking']      = BookingRequest::count();
        $widget['pending_booking']    = BookingRequest::pending()->count();
        $widget['pending_messages']   = SupportTicket::whereIn('status', [Status::TICKET_OPEN, Status::TICKET_REPLY])->count();
        $widget['total_subscribers']  = Subscriber::count();

        $recentPickups  = PickupRequest::latest()->limit(5)->get();
        $recentQuotes   = QuoteRequest::latest()->limit(5)->get();
        $recentBookings = BookingRequest::latest()->limit(5)->get();
        $tickets        = SupportTicket::with('user')->where('status', Status::TICKET_OPEN)->latest()->limit(5)->get();

        return view('Admin::dashboard', compact('pageTitle', 'widget', 'recentPickups', 'recentQuotes', 'recentBookings', 'tickets'));
    }


    public function profile()
    {
        $pageTitle = 'Profile';
        $admin = auth('admin')->user();
        return view('Admin::profile', compact('pageTitle', 'admin'));
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'image' => ['nullable','image',new FileTypeValidate(['jpg','jpeg','png'])]
        ]);
        $user = auth('admin')->user();

        if ($request->hasFile('image')) {
            try {
                $old = $user->image;
                $user->image = fileUploader($request->image, getFilePath('adminProfile'), getFileSize('adminProfile'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $notify[] = ['success', 'Profile has been updated successfully'];
        return to_route('admin.profile')->withNotify($notify);
    }


    public function password()
    {
        $pageTitle = 'Password Setting';
        $admin = auth('admin')->user();
        return view('Admin::profile', compact('pageTitle', 'admin'));
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:5|confirmed',
        ]);

        $user = auth('admin')->user();
        if (!Hash::check($request->old_password, $user->password)) {
            $notify[] = ['error', 'Password doesn\'t match!!'];
            return back()->withNotify($notify);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        $notify[] = ['success', 'Password changed successfully.'];
        return to_route('admin.profile')->withNotify($notify);
    }

    public function notifications(){
        $notifications = AdminNotification::orderBy('id','desc')->with('user')->paginate(getPaginate());
        $pageTitle = 'Notifications';
        return view('Admin::notifications',compact('pageTitle','notifications'));
    }


    public function notificationRead($id){
        $notification = AdminNotification::findOrFail($id);
        $notification->read_status = Status::YES;
        $notification->save();
        $url = $notification->click_url;
        if ($url == '#') {
            $url = url()->previous();
        }
        return redirect($url);
    }

    public function readAll(){
        AdminNotification::where('read_status',Status::NO)->update([
            'read_status'=>Status::YES
        ]);
        $notify[] = ['success','Notifications read successfully'];
        return back()->withNotify($notify);
    }

    public function downloadAttachment($fileHash)
    {
        $filePath = decrypt($fileHash);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $general = gs();
        $title = slug($general->site_name).'- attachments.'.$extension;
        $mimetype = mime_content_type($filePath);
        header('Content-Disposition: attachment; filename="' . $title);
        header("Content-Type: " . $mimetype);
        return readfile($filePath);
    }


}
