<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\Event\MessageEvent\TextMessage;

class LineBotController extends Controller
{
    public function index(Request $request)
    {
        //認証を行う
        $lineAccessToken = config('services.line.access_token');
        $lineChannelSecret = config('services.line.channel_secret');

        $httpClient = new CurlHTTPClient($lineAccessToken);
        $lineBot = new LINEBot($httpClient, ['channelSecret' => $lineChannelSecret]);

        $signature = $request->header('x-line-signature');

        if (!$lineBot->validateSignature($request->getContent(), $signature)) {
            //送信元に400エラーを伝える
            abort(400, 'Invalid signature');
        }

        //LINEで入力されたメッセージ情報を受け取る
        $events = $lineBot->parseEventRequest($request->getContent(), $signature);
    }
}
