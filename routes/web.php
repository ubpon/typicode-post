<?php

use App\Http\Controllers\WebhookController;
use App\Http\Middleware\IpWhitelist;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/callback', [WebhookController::class, 'handleCallback'])
    ->middleware(IpWhitelist::class)
    ->withoutMiddleware([VerifyCsrfToken::class]);
