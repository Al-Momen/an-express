<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\BookingRequest;
use Illuminate\Http\Request;

class BookingRequestController extends Controller
{
    public function index(Request $request)
    {
        $pageTitle = 'Online Bookings';

        $bookings = BookingRequest::searchable([
            'shipper_name', 'shipper_email', 'shipper_phone',
            'consignee_name', 'consignee_country',
        ])->orderBy('id', 'desc')->paginate(getPaginate());

        return view('Admin::booking.index', compact('pageTitle', 'bookings'));
    }

    public function view($id)
    {
        $booking   = BookingRequest::findOrFail($id);
        $pageTitle = 'Online Booking Details';

        return view('Admin::booking.detail', compact('pageTitle', 'booking'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', [
                Status::BOOKING_PENDING,
                Status::BOOKING_PROCESSING,
                Status::BOOKING_COMPLETED,
                Status::BOOKING_CANCELLED,
            ]),
        ]);

        $booking = BookingRequest::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        $notify[] = ['success', 'Booking status has been updated'];
        return back()->withNotify($notify);
    }

    public function destroy($id)
    {
        $booking = BookingRequest::findOrFail($id);
        $booking->delete();

        $notify[] = ['success', 'Booking has been deleted'];
        // Redirected explicitly rather than back(): a delete from the detail
        // page would otherwise send the browser back to that now-gone record.
        return to_route('admin.booking.index')->withNotify($notify);
    }
}
