<?php

$app->post('/contact', [
    'uses' => 'App\Http\Controllers\ContactController@newMessage'
]);

$app->get('/', function () use ($app) {
    return response()->json(['ok'], 200);
});
