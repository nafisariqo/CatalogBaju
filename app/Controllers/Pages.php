<?php

namespace App\Controllers;

class Pages extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'Home | Women Stylish'
		];
		echo view('layout/header', $data);
		echo view('pages/home');
		echo view('layout/footer');
	}

    public function about()
	{
		$data = [
			'title' => 'About Me'
		];
		echo view('layout/header', $data);
		echo view('pages/about');
		echo view('layout/footer');
	}

	public function contact()
	{
		$data = [
			'title' => 'Contact Us'
		];
		echo view('layout/header', $data);
		echo view('pages/contact');
		echo view('layout/footer');
	}
}
