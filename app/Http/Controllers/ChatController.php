<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Models\CustomerSession;
use App\Models\User;

class ChatController extends Controller
{
    public function register()
    {
        $captcha = $this->generateCaptcha();

        return view(
            'customer.register',
            compact('captcha')
        );
    }

    public function refreshCaptcha()
    {
        $captcha = $this->generateCaptcha();

        return response()->json([
            'captcha' => $captcha
        ]);
    }

    private function generateCaptcha()
    {
        $captcha = strtoupper(
            Str::random(6)
        );

        session([
            'captcha_code' => $captcha
        ]);

        return $captcha;
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'captcha' => 'required'
        ], [
            'customer_name.required'
            => 'this column is mandatory',

            'email.required'
            => 'this column is mandatory',

            'phone.required'
            => 'this column is mandatory',

            'captcha.required'
            => 'this column is mandatory',

            'email.email'
            => 'Invalid email format'
        ]);

        if (
            strtoupper($request->captcha)
            != session('captcha_code')
        ) {

            return back()
                ->with(
                    'error',
                    'Captcha code does not match'
                );
        }

        $session = CustomerSession::create([

            'customer_name'
            => $request->customer_name,

            'email'
            => $request->email,

            'phone'
            => $request->phone,

            'last_activity'
            => now()
        ]);

        return redirect('/queue/' . $session->id);
    }

    public function queue($id)
    {
        $session = CustomerSession::findOrFail($id);

        return view(
            'customer.queue',
            compact('session')
        );
    }

    public function checkSD($id)
    {
        $session = CustomerSession::findOrFail($id);

        $sd = User::where(
            'status_online',
            true
        )->first();

        if ($sd) {

            $session->update([
                'session_status' => 'connected',
                'assigned_sd_id' => $sd->id
            ]);

            return response()->json([
                'status' => 'connected'
            ]);
        }

        return response()->json([
            'status' => 'waiting'
        ]);
    }

    public function chat($id)
    {
        $session = CustomerSession::findOrFail($id);

        $messages =
            ChatMessage::where(
                'customer_session_id',
                $id
            )
            ->orderBy('id', 'asc')
            ->get();

        return view(
            'customer.chat',
            compact('session', 'messages')
        );
    }

    public function workspace()
    {
        $sessions =
            CustomerSession::latest()
            ->get();

        return view(
            'sd.workspace',
            compact('sessions')
        );
    }

    public function sdChat($id)
    {
        $session = CustomerSession::findOrFail($id);
        $messages =
            ChatMessage::where(
                'customer_session_id',
                $id
            )
            ->orderBy('id', 'asc')
            ->get();

        return view(
            'sd.chat',
            compact('session', 'messages')
        );
    }

    public function saveMessage(Request $request)
    {
        ChatMessage::create([
            'customer_session_id' =>
            $request->session_id,

            'sender' =>
            $request->sender,

            'message' =>
            $request->message
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function masterCustomer()
    {
        $response =
            Http::get(
                'https://randomuser.me/api?results=10&page=1'
            );

        $results =
            $response->json()['results'];

        $customers = [];
        foreach ($results as $item) {
            $customers[] = [
                'name' =>
                $item['name']['title']
                    . ' ' .
                    $item['name']['first']
                    . ' ' .
                    $item['name']['last'],

                'email' =>
                $item['email'],

                'login' => [
                    'uuid' =>
                    $item['login']['uuid'],

                    'username' =>
                    $item['login']['username'],

                    'password' =>
                    $item['login']['password']
                ],

                'phone' =>
                $item['phone'],

                'cell' =>
                $item['cell'],

                'picture' => [
                    'large' =>
                    $item['picture']['large'],

                    'medium' =>
                    $item['picture']['medium'],

                    'thumbnail' =>
                    $item['picture']['thumbnail']
                ]
            ];
        }

        return view(
            'sd.master_customer',
            compact('customers')
        );
    }
}
