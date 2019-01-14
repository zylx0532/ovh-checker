<?php
	use App\Server;
	use App\Notice;
	use Mail;

	//---------------------------------------------
	function send_notification_emails()
	{
		$notes = Notice::get();

		foreach ($notes as $n)
		{
			$email = $n->email;
			$server = $n->server;

			$server_stock = Server::where('code', $server)->first();

			if ($server_stock === null)
			{
				continue;
			}

			if (!$server_stock->available)
			{
				continue;
			}

			$txt = "Your server is in stock and can be ordered here: https://www.kimsufi.com/en/order/kimsufi.xml?reference={$server}";

			Mail::raw($txt, function($message) use ($email)
			{
			    $message->from('info@realm.pw', 'Realm OVH Notification');
			    $message->to( $email )->subject('Server is in stock');
			});

			$n->delete();
		}
	}


	//---------------------------------------------
	function refresh_ovh_servers()
	{
		$data = file_get_contents("https://ws.ovh.com/dedicated/r2/ws.dispatcher/getAvailability2");

		$json = json_decode($data);

		$servers = &$json->answer->availability;

		$map = [ 
			'1801sk12', '1801sk13', '1801sk14', '1801sk15', 
			'1801sk16', '1801sk17','1801sk18','1801sk19',
			'1801sk20', '1801sk21','1801sk22','1801sk23'
		];

		foreach ($servers as $s)
		{
			if (in_array($s->reference, $map))
			{
				$available = ( int )($s->metaZones[1]->availability !== 'unavailable');
				$rbx = false;
				$gra = false;
				$sbg = false;
		
				foreach ($s->zones as $z)
				{
					if ($z->zone == 'rbx')
					{
						$rbx = ($z->availability != 'unavailable' ? $z->availability : null );
					}
					else if ($z->zone == 'gra')
					{
						$gra = ($z->availability != 'unavailable' ? $z->availability : null );
					}
					else if ($z->zone == 'sbg')
					{
						$sbg = ($z->availability != 'unavailable' ? $z->availability : null );
					}
				}
				
				$serv = Server::where('code', $s->reference)->first();
				$serv->available = $available;
				$serv->rbx = $rbx;
				$serv->gra = $gra;
				$serv->sbg = $sbg;
				$serv->save();
			}
		}

		return true;
	}
?>
