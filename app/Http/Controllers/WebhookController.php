<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handleCallback(Request $request)
    {
        Log::info('Attempted to received callback', ['data' => $request->ip()]);

        /**
         * We can use also this one aside from middleware

        if (!in_array($request->ip(), config('webhook.trusted_ips'))) {
            Log::warning('Untrusted callback source', ['ip' => $request->ip()]);
            return response()->json(['message' => 'Forbidden'], 403);
        }
         **/

        return response()->json(['message' => 'Success']);
    }
}
