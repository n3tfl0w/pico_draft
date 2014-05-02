<?php

/**
 * Plugin for Draft integration
 *
 * @author Zvonko Biškup
 * @link http://www.codeforest.net
 * @license http://opensource.org/licenses/MIT
 * @version 1.0
 */
class Pico_Draft {
	
	public function request_url(&$url)
	{
		// change this to something that is not easily guessed!!!
		// you will need this URL to set up a webhook on Draft settings page
		if ('a4337bc45a8fc543c03f52dc758cd6e1e87021bc896588bd79e901e3' == $url) {
			// getting the payload, decoding it and saving to file system inside content dir
			if ($_POST['payload']) {
				// we have a request from Draft, let's save it to file
				$data = $_REQUEST["payload"];           
				$unescaped_data = stripslashes($data);
				$payload = json_decode($unescaped_data);
				$fileName = strtolower($payload->name) . CONTENT_EXT;
				@file_put_contents(CONTENT_DIR . $fileName, $payload->content);
			}
			exit; // stop everything!	
		}	
	}
}