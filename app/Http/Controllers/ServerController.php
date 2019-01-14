<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Server;
use App\Notice;
use Session;

class ServerController extends Controller
{
	//---------------------------------------------
	public function subscribe()
	{
		$this->validate(request(), [
			'email' => 'required|email',
			'server' => 'required|size:8'
		]);

		$email = request('email');
		$server = request('server');

		$notice = Notice::where('email', $email)->where('server', $server)->first();
		
		if ($notice !== null)
		{
			Session::flash('message', 'You are already subscribed to that server');
			
			return redirect()->route('home');
		}

		$n = new Notice();
		$n->email = $email;
		$n->server = $server;
		$n->save();

		Session::flash('message', 'Success! You will be notified when the server is next in stock.');

		return redirect()->route('home');
	}

	//---------------------------------------------
	public function index()
	{
		$servers = Server::get();

		return view('index')->with('servers', $servers);
	}
}
