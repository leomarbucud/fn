<?php

require __DIR__ . '/Twilio/autoload.php';

use Twilio\Rest\Client;

class SMS {

	private $sid = 'ACa3c6bf37c7fb258265a4c6c06eb3389f';
	// private $sid = 'MGd27491a9a8850ca68886b79a530c2553';
	private $token = '006bc17df734f25577019556bfb1a7f8';
	private $client = null;

	public $message = null;
	public $to = null;
	public $from = null;

	public function __construct() {
		$this->client = new Client($this->sid, $this->token);	
	}

	public function send(){
		try {
			$this->client->messages->create(
			    $this->to,
			    array(
			        'from' => $this->from,
			        'body' => $this->message
			    )
			);
			return true;
		} catch (Exception $e) {
			var_dump($e);
			return false;
		}
	}
}