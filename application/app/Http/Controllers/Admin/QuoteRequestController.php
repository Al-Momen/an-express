<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;

class QuoteRequestController extends Controller
{
    public function index(Request $request)
    {
        $pageTitle = 'Quote Requests';

        $quotes = QuoteRequest::searchable(['name', 'email', 'phone', 'destination_country'])
            ->orderBy('id', 'desc')
            ->paginate(getPaginate());

        return view('Admin::quote.index', compact('pageTitle', 'quotes'));
    }

    public function view($id)
    {
        $quote     = QuoteRequest::findOrFail($id);
        $pageTitle = 'Quote Request Details';

        return view('Admin::quote.detail', compact('pageTitle', 'quote'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', [
                Status::QUOTE_PENDING,
                Status::QUOTE_PROCESSING,
                Status::QUOTE_COMPLETED,
                Status::QUOTE_CANCELLED,
            ]),
        ]);

        $quote = QuoteRequest::findOrFail($id);
        $quote->status = $request->status;
        $quote->save();

        $notify[] = ['success', 'Quote request status has been updated'];
        return back()->withNotify($notify);
    }

    public function destroy($id)
    {
        $quote = QuoteRequest::findOrFail($id);
        $quote->delete();

        $notify[] = ['success', 'Quote request has been deleted'];
        // Redirected explicitly rather than back(): a delete from the detail
        // page would otherwise send the browser back to that now-gone record.
        return to_route('admin.quote.index')->withNotify($notify);
    }
}
