<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Jobs\InfluxQueue;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::get('/redirect', function (Request $request) {
    // dd($request->query());

    // http://127.0.0.1:8000/redirect?target=https://*.com/@fwdforward/7XFVL5o.m4a?metric=connect%26category=601%26bot=4
    // metric:默认是connect 收听/看/点击链接
    // by：author 可选 %26author=@fwdforward
    // http://127.0.0.1:8000/redirect?target=https://navs.savefamily.net%3Fvips=10,15,11,16,17%26metric=NFC%26keyword=nav

    // %3F ?
    // %26 &
    $url = $request->query('target');
    $status = 302;
    $ip = $request->header('x-forwarded-for')??$request->ip();
    $parts = parse_url($url); //$parts['host']
    // $paths = pathinfo($url); //mp3
    $parsedUrl = parse_url($url);
    $headers = ['referer' => $parsedUrl['scheme'] . '://' . $parsedUrl['host']]; //strtok($url, '?')//remove ?q=xxx

    $target = basename($url); //cc201221.mp3
    
    $tags = [];
    if(isset($parts['query'])) parse_str($parts['query'], $tags);
    $tags['host'] = $parts['host'];
    // measurement/metric
    // $tags = http_build_query($data, '', ',');// category=603,bot=4    

    $fields = [];
    $fields['count'] = 1;
    $fields['target'] = strtok($target, '?');
    $fields['ip'] = $ip;
    // $fields = http_build_query($fields, '', ',');// category=603,bot=4
    
    // 原始获取人！
    // $url .= '%26to='.$to; //unset(to) => Field[to]=wxid;
    if(isset($tags['to'])) {
        $fields['to'] = $tags['to'];
        unset($tags['to']);
    }
    // ?_=1
    if(isset($tags['_'])) unset($tags['_']);

    $protocolLine = [
        'name' => 'click', //action=click/listen/view/tap
        'tags' => $tags,
        'fields' => $fields
    ];
    // $protocolLine = $metric.$tags.' count=1i,target="'.$target.'",ip="'.$ip.'"';
    // ly-listen,category=603,bot=%E5%8F%8B4count=1i,target="ee230909.mp3"
    // dd($protocolLine,$parts,$url);
    InfluxQueue::dispatchAfterResponse($protocolLine);
    return redirect()->away($url, $status, $headers);
});

Route::get('/go/pastorlu', function (Request $request){
    $res = Http::get("https://x-resources.vercel.app/resources/801")->json();
    $url = '/redirect?target=' . $res['data']['url'] . '?metric=PastorLu%26keyword=nav%26type=video';
    return redirect()->away($url, $status=302);
});