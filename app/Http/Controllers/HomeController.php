<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class HomeController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $host;

    public function __construct()
    {
        $this->host = env('API_HOST');

    }

    public function GetApi($url)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get($url);
        $response = $request->getBody();
        return $response;
    }

    public function PostApi($url,$body) {
        $client = new \GuzzleHttp\Client();
        $response = $client->request("POST", $url, ['form_params'=>$body]);
        $response = $client->send($response);
        return $response;
    }

    public function index()
    {
        $result = $this->GetApi($this->host.'pools');
        $json_content = json_decode($result);
        $pools = $json_content->pools;
        foreach ($pools as $pool){
            Session::put($pool->id, $pool);
        }
        $page = 'home';
        return view('page.index', compact('pools','page'));
    }

    public function admin(Request $request, $id)
    {
        $result = $this->GetApi($this->host.'pools/'.$id.'/performance');
        $json_content = json_decode($result);
        $stats = $json_content->stats;
        Session::put('id', $id);
        $page = 'stats';
        return view('page.stats', compact('stats', 'page'));
    }

    public function miners($id)
    {
        $result = $this->GetApi($this->host.'pools/'.$id.'/miners');
        $json_content = json_decode($result);
        $miners = $json_content;
//        Session::put('miners', $miners);
        $page = 'miners';
        return view('page.miners', compact('miners','page'));
    }

    public function blocks($id)
    {
        $result = $this->GetApi($this->host.'pools/'.$id.'/miners');
        $json_content = json_decode($result);
        $miners = $json_content;
//        Session::put('miners', $miners);
        $page = 'blocks';
        return view('page.miners', compact('blocks','page'));
    }
}
