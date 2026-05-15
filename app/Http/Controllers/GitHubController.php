<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // ဤစာကြောင်းကို ထည့်ပါ

class GitHubController extends Controller
{
    public function getUserData()
    {
        // ဤနေရာတွင် သင်၏ ကုဒ်ကို ထည့်ပါ
        $response = Http::withHeaders([
            'User-Agent' => 'MyLaravelApp', // GitHub အတွက် User-Agent မဖြစ်မနေ လိုအပ်ပါသည်
        ])->withOptions([
            'curl' => [
                CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
                CURLOPT_TIMEOUT => 30,
            ],
            'verify' => false, // အကယ်၍ Local မှာ SSL error တက်နေသေးလျှင် ဤစာကြောင်းကို ခေတ္တထည့်နိုင်သည်
        ])->get('api.github.com');

        // ရလဒ်ကို စစ်ဆေးခြင်း
        if ($response->successful()) {
            return $response->json();
        }

        return "Error occurred: " . $response->body();
    }
}
