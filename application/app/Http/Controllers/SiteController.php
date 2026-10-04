<?php

namespace App\Http\Controllers;
use App\Constants\Status;
use App\Models\AdminNotification;
use App\Models\BookingRequest;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\Page;
use App\Models\PickupRequest;
use App\Models\QuoteRequest;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use App\Models\Subscriber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SiteController extends Controller
{
    public function index(){
        if (isset($_GET['reference'])) {
            session()->put('reference', $_GET['reference']);
        }
        $pageTitle = 'Home';
        $sections = Page::where('slug','/')->first();
        return view('Template::home', compact('pageTitle','sections'));
    }

    public function pages($slug)
    {
        $page = Page::where('slug',$slug)->firstOrFail();
        $pageTitle = $page->name;
        return view('Template::pages', compact('pageTitle', 'page'));
    }


    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:40|unique:subscribers,email',
        ]);

        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->save();

        $notify[] = ['success', 'Subscribed successfully'];
        return back()->withNotify($notify);
    }


    public function pickupRequest()
    {
        $pageTitle = 'Pick-Up Request';
        $sections  = Page::where('slug', 'pickup')->first();
        return view('Template::pickup', compact('pageTitle', 'sections'));
    }


    public function pickupRequestStore(Request $request)
    {
        $request->validate([
            'company_name'         => 'nullable|string|max:100',
            'name'                 => 'required|string|max:100',
            'email'                => 'required|email|max:100',
            'phone'                => 'required|string|max:30',
            'pickup_time'          => 'required|date',
            'destination_country'  => 'required|string|max:100',
            'pickup_address'       => 'required|string|max:255',
            'weight'               => 'required|string|max:30',
            'item_type'            => 'nullable|string|max:100',
            'message'              => 'nullable|string|max:1000',
        ]);

        $pickup = new PickupRequest();
        $pickup->company_name        = $request->company_name;
        $pickup->name                = $request->name;
        $pickup->email               = $request->email;
        $pickup->phone               = $request->phone;
        $pickup->pickup_time         = $request->pickup_time;
        $pickup->destination_country = $request->destination_country;
        $pickup->pickup_address      = $request->pickup_address;
        $pickup->weight              = $request->weight;
        $pickup->item_type           = $request->item_type;
        $pickup->message             = $request->message;
        $pickup->status              = Status::PICKUP_PENDING;
        $pickup->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id   = 0;
        $adminNotification->title     = 'A new pickup request has been submitted';
        $adminNotification->click_url = urlPath('admin.pickup.view', $pickup->id);
        $adminNotification->save();

        $notify[] = ['success', 'Your pickup request has been submitted. Our team will contact you shortly.'];
        return back()->withNotify($notify);
    }


    public function quoteRequest()
    {
        $pageTitle = 'Get a Quote';
        $sections  = Page::where('slug', 'quote')->first();
        return view('Template::quote', compact('pageTitle', 'sections'));
    }


    public function quoteRequestStore(Request $request)
    {
        $request->validate([
            'name'                => 'required|string|max:100',
            'email'               => 'required|email|max:100',
            'phone'               => 'required|string|max:30',
            'item_type'           => 'required|string|max:100',
            'weight'              => 'required|string|max:30',
            'destination_country' => 'required|string|max:100',
            'collection_option'   => 'required|string|max:255',
            'message'             => 'nullable|string|max:1000',
        ]);

        $quote = new QuoteRequest();
        $quote->name                = $request->name;
        $quote->email               = $request->email;
        $quote->phone               = $request->phone;
        $quote->item_type           = $request->item_type;
        $quote->weight              = $request->weight;
        $quote->destination_country = $request->destination_country;
        $quote->collection_option   = $request->collection_option;
        $quote->message             = $request->message;
        $quote->status              = Status::QUOTE_PENDING;
        $quote->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id   = 0;
        $adminNotification->title     = 'A new quote request has been submitted';
        $adminNotification->click_url = urlPath('admin.quote.view', $quote->id);
        $adminNotification->save();

        $notify[] = ['success', 'Your quote request has been submitted. Our team will contact you shortly.'];
        return back()->withNotify($notify);
    }


    public function onlineBooking()
    {
        $pageTitle = 'Online Booking';
        $sections  = Page::where('slug', 'book')->first();
        return view('Template::book', compact('pageTitle', 'sections'));
    }


    public function onlineBookingStore(Request $request)
    {
        $request->validate([
            'shipper_name'        => 'required|string|max:100',
            'shipper_company'     => 'required|string|max:100',
            'shipper_phone'       => 'required|string|max:30',
            'shipper_email'       => 'required|email|max:100',
            'shipper_country'     => 'required|string|max:100',
            'shipper_city'        => 'required|string|max:100',
            'shipper_zip'         => 'required|string|max:20',
            'shipper_address'     => 'required|string|max:500',

            'consignee_name'      => 'required|string|max:100',
            'consignee_company'   => 'required|string|max:100',
            'consignee_phone'     => 'required|string|max:30',
            'consignee_email'     => 'required|email|max:100',
            'consignee_country'   => 'required|string|max:100',
            'consignee_city'      => 'required|string|max:100',
            'consignee_zip'       => 'required|string|max:20',
            'consignee_address'   => 'required|string|max:500',

            'payment_mode'        => 'required|string|max:30',
            'shipment_ref'        => 'nullable|string|max:100',
            'pieces'              => 'required|integer|min:1',
            'declared_value'      => 'nullable|string|max:30',
            'weight_kg'           => 'required|string|max:20',
            'weight_gm'           => 'nullable|string|max:20',
            'item_type'           => 'required|string|max:50',
            'item_description'    => 'required|string|max:255',
            'remarks'             => 'nullable|string|max:1000',

            'length'              => 'nullable|string|max:20',
            'height'              => 'nullable|string|max:20',
            'width'               => 'nullable|string|max:20',
            'volumetric_weight'   => 'nullable|string|max:20',
        ]);

        $booking = new BookingRequest($request->only([
            'shipper_name', 'shipper_company', 'shipper_phone', 'shipper_email',
            'shipper_country', 'shipper_city', 'shipper_zip', 'shipper_address',
            'consignee_name', 'consignee_company', 'consignee_phone', 'consignee_email',
            'consignee_country', 'consignee_city', 'consignee_zip', 'consignee_address',
            'payment_mode', 'shipment_ref', 'pieces', 'declared_value',
            'weight_kg', 'weight_gm', 'item_type', 'item_description', 'remarks',
            'length', 'height', 'width', 'volumetric_weight',
        ]));
        $booking->status = Status::BOOKING_PENDING;
        $booking->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id   = 0;
        $adminNotification->title     = 'A new online booking has been submitted';
        $adminNotification->click_url = urlPath('admin.booking.view', $booking->id);
        $adminNotification->save();

        $notify[] = ['success', 'Your booking has been submitted. Our team will confirm it shortly.'];
        return back()->withNotify($notify);
    }


    public function contact()
    {
        $pageTitle = "Contact Us";
        $sections = Page::where('slug','contact')->first();
        return view('Template::contact',compact('pageTitle', 'sections'));
    }


    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required',
            'phone' => 'nullable|string|max:40',
        ]);

        if(!verifyCaptcha()){
            $notify[] = ['error','Invalid captcha provided'];
            return back()->withNotify($notify);
        }

        $request->session()->regenerateToken();

        $random = getNumber();

        $ticket = new SupportTicket();
        $ticket->user_id = auth()->id() ?? 0;
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->priority = 2;


        $ticket->ticket = $random;
        $ticket->subject = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status = 0;
        $ticket->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = auth()->user() ? auth()->user()->id : 0;
        $adminNotification->title = 'A new support ticket has opened ';
        $adminNotification->click_url = urlPath('admin.ticket.view',$ticket->id);
        $adminNotification->save();

        $message = new SupportMessage();
        $message->support_ticket_id = $ticket->id;
        // The tickets table has no phone column, so keep it with the message body.
        $message->message = $request->phone
            ? 'Phone: ' . $request->phone . "\n\n" . $request->message
            : $request->message;
        $message->save();

        $notify[] = ['success', 'Ticket created successfully!'];

        return to_route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function policyPages($slug,$id)
    {
        $policy = Frontend::where('id',$id)->where('data_keys','policy_pages.element')->firstOrFail();
        $pageTitle = $policy->data_values->title;
        return view('Template::policy',compact('policy','pageTitle'));
    }

    public function changeLanguage($lang = null)
    {
        $language = Language::where('code', $lang)->first();
        if (!$language) $lang = 'en';
        session()->put('lang', $lang);
        return back();
    }

    public function blog()
    {
        $pageTitle = 'Blog';

        $blogs = Frontend::where('data_keys', 'blog.element');

        // The card fields live inside the data_values JSON column, so filtering
        // has to reach into the JSON rather than a plain column.
        if (request()->search) {
            $search = request()->search;
            $blogs->where(function ($query) use ($search) {
                $query->where('data_values->title', 'like', "%$search%")
                    ->orWhere('data_values->description', 'like', "%$search%");
            });
        }

        if (request()->category) {
            $blogs->where('data_values->category', request()->category);
        }

        $blogs = $blogs->orderBy('created_at', 'desc')->paginate(getPaginate(6));

        // Lets the admin append builder sections below the listing, like any
        // other page.
        $sections = Page::where('slug', 'blog')->first();

        return view('Template::blog', compact('pageTitle', 'blogs', 'sections'));
    }


    public function blogDetails($slug,$id){
        $blog = Frontend::where('id',$id)->where('data_keys','blog.element')->firstOrFail();
        $pageTitle = $blog->data_values->title;

        return view('Template::blog_details',compact('blog','pageTitle'));
    }


    public function cookieAccept(){
        $general = gs();
        Cookie::queue('gdpr_cookie', $general->site_name , 43200);
        return back();
    }

    public function cookiePolicy(){
        $pageTitle = 'Cookie Policy';
        $cookie = Frontend::where('data_keys','cookie.data')->first();
        return view('Template::cookie',compact('pageTitle','cookie'));
    }

    public function maintenance()
    {
        $pageTitle = 'Maintenance Mode';
        $general = gs();
        if($general->maintenance_mode){
            $maintenance = Frontend::where('data_keys','maintenance.data')->first();
            return view('Template::maintenance',compact('pageTitle','maintenance'));
        }
        return to_route('home');
    }

    public function placeholderImage($size = null){
        $imgWidth = explode('x',$size)[0];
        $imgHeight = explode('x',$size)[1];
        $text = $imgWidth . '×' . $imgHeight;
        $fontFile = realpath('assets/font') . DIRECTORY_SEPARATOR . 'RobotoMono-Regular.ttf';
        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if($imgHeight < 100 && $fontSize > 30){
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 255, 255, 255);
        $bgFill    = imagecolorallocate($image, 28, 35, 47);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }
}
