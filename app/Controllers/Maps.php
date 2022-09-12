<?php namespace App\Controllers;

class Maps extends BaseController
{
	public function index()
	{
		$fileName = base_url("maps/pontianak.geojson");
		$file = file_get_contents($fileName);
		$file = json_decode($file);

		return view('maps/index');
	}

	//--------------------------------------------------------------------

}