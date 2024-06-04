<?php

namespace App;
use Illuminate\Support\Facades\Http;

class RandomUser{
    public function getData(){
        $response = Http::get('https://randomuser.me/api/');
        return $response->object();
    }
}
