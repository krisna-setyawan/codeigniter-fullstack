<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Pasien extends CI_Controller
{

	public function get_pasien($id = null)
	{
		$client = new Client();

		$token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ0aW1lIjoxNjY2NzU5MzYyLCJ1c2VybmFtZSI6ImNvYmEiLCJpYXQiOjE2NjY3NTkzNjIsImV4cCI6MTY2Njc2Mjk2Mn0.Pq_pHgjkASPbmi839XJidkx5YzkxmHBBc5O0lO61xug";
		$url = "http://localhost/ci3-ci4-fullstack/restful/pasien/$id";
		$headers = [
			'Authorization' => 'Bearer ' . $token
		];
		$response = $client->request('GET', $url, ['headers' => $headers, 'http_errors' => false]);

		echo $response->getBody();
	}

	public function add_pasien()
	{
		$client = new Client();

		$token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ0aW1lIjoxNjY2NzU5MzYyLCJ1c2VybmFtZSI6ImNvYmEiLCJpYXQiOjE2NjY3NTkzNjIsImV4cCI6MTY2Njc2Mjk2Mn0.Pq_pHgjkASPbmi839XJidkx5YzkxmHBBc5O0lO61xug";
		$url = "http://localhost/ci3-ci4-fullstack/restful/pasien";
		$headers = [
			'Authorization' => 'Bearer ' . $token
		];

		$data = [
			'no_rm' => 999,
			'nama' => 'px coba lagi'
		];

		$response = $client->request('POST', $url, ['form_params' => $data, 'headers' => $headers, 'http_errors' => false]);

		echo $response->getBody();
	}
}
