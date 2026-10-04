<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\PickupRequest;
use Illuminate\Http\Request;

class PickupRequestController extends Controller
{
    public function index(Request $request)
    {
        $pageTitle = 'Pickup Requests';

        $pickups = PickupRequest::searchable(['name', 'email', 'phone', 'pickup_address'])
            ->orderBy('id', 'desc')
            ->paginate(getPaginate());

        return view('Admin::pickup.index', compact('pageTitle', 'pickups'));
    }

    public function view($id)
    {
        $pickup    = PickupRequest::findOrFail($id);
        $pageTitle = 'Pickup Request Details';

        return view('Admin::pickup.detail', compact('pageTitle', 'pickup'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', [
                Status::PICKUP_PENDING,
                Status::PICKUP_PROCESSING,
                Status::PICKUP_COMPLETED,
                Status::PICKUP_CANCELLED,
            ]),
        ]);

        $pickup = PickupRequest::findOrFail($id);
        $pickup->status = $request->status;
        $pickup->save();

        $notify[] = ['success', 'Pickup request status has been updated'];
        return back()->withNotify($notify);
    }

    public function destroy($id)
    {
        $pickup = PickupRequest::findOrFail($id);
        $pickup->delete();

        $notify[] = ['success', 'Pickup request has been deleted'];
        // Redirected explicitly rather than back(): a delete from the detail
        // page would otherwise send the browser back to that now-gone record.
        return to_route('admin.pickup.index')->withNotify($notify);
    }
}
