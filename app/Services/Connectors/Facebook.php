<?php

namespace App\Services\Connectors;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendFacebookReply;

class Facebook extends Connector
{
    public function connect($twinId)
    {
        session(['connection_for_twin_id' => $twinId]);
        $url = "https://www.facebook.com/v18.0/dialog/oauth?client_id=" . config('services.facebook.app_id') .
            "&redirect_uri=" . urlencode(config('services.facebook.redirect_uri')) .
            "&scope=pages_manage_metadata,pages_messaging";

            // dd(config('services.facebook.app_id'));
        return redirect($url);
    }

    public function callback($code)
    {

        $tokenResponse = Http::asForm()->post('https://graph.facebook.com/v18.0/oauth/access_token', [
            'client_id' => config('services.facebook.app_id'),
            'client_secret' => config('services.facebook.app_secret'),
            'redirect_uri' => config('services.facebook.redirect_uri'),
            'code' => $code,
        ])->json();

        // dd( $tokenResponse );

        if (isset($tokenResponse['error'])) {
           return $tokenResponse;
        }
        session(['user_access_token' => $tokenResponse['access_token']]);

        $pages = Http::get("https://graph.facebook.com/v18.0/me/accounts", [
            'access_token' =>$tokenResponse['access_token'],
        ])->json()['data'];

        return $pages ;

        // return view('select-page', ['pages' => $pages]);
    }

    public function verifyWebhook(Request $request)
    {
        if ($request->input('hub_mode') === 'subscribe' && $request->input('hub_verify_token') === config('services.facebook.verify_token')) {
            return response($request->input('hub_challenge'));
        }
        abort(403, 'Invalid verification token');
    }

    public function webhook(Request $request)
    {
        Log::info('Webhook received:', $request->all());

        foreach ($request->input('entry') as $entry) {
            foreach ($entry['messaging'] as $event) {
                if (isset($event['message'])) {
                    $senderId = $event['sender']['id'];
                    $message = $event['message']['text'];

                    // Log the message
                    $log = new \App\Models\MessageLog();
                    $log->sender_id = $senderId;
                    $log->message = $message;
                    $log->save();

                    // Queue reply
                    SendFacebookReply::dispatch($senderId, "Got it :)");
                }
            }
        }

        return response('EVENT_RECEIVED', 200);
    }

    public function confirmPage($page)
    {
        $pages = Http::get("https://graph.facebook.com/v18.0/me/accounts", [
            'access_token' => session('user_access_token'),
        ])->json();
        if(!isset($pages['data'])) {
            return $pages;
        }

        // Find the selected page's access token
        $selectedPage = collect($pages['data'])->firstWhere('id', $page['id']);
        if (!$selectedPage) {
            return redirect()->back()->withErrors(['error' => 'Invalid page selection.']);
        }
    
        $subscriptions = Http::post("https://graph.facebook.com/v22.0/{$page['id']}/subscribed_apps", [
            'subscribed_fields' => 'messages,messaging_postbacks',
            'access_token' => $selectedPage['access_token'],
        ]);

    
        session()->forget(['user_access_token','connection_for_twin_id','user_access_token','auth_pages']);
        return $subscriptions  ;
        // return view('confirmation',compact('pageId', 'selectedPage', 'subscriptions'));
    }
}