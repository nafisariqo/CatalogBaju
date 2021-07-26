<?php

namespace App\Controllers;

use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class News extends BaseController
{
	protected $newsModel;
	public function __construct()
	{
		$this->newsModel = new NewsModel();
	}

	public function index()
	{
		$currentPage = $this->request->getVar('page_news') ? $this->request->getVar('page_news') : 1;

		$keywoard = $this->request->getVar('keyword');
		if($keywoard){
			$nw = $this->newsModel->search($keywoard);
		}else{
			$nw = $this->newsModel;
		}
		   $data = [
            'title' => 'Daftar News Women Stylish',
			// 'news' => $this->newsModel->getNews()
			'news' => $nw->paginate(4, 'news'),
			'pager' => $this->newsModel->pager,
			'currentPage' => $currentPage
        ];


        return view('news/index', $data);
	}

	public function detail($slug)
	{
		$data = [
			'title' => 'Detail News',
			'news' => $this->newsModel->getNews($slug)
		];

		//jika news tidak ada ditabel
		if (empty($data['news'])){
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul news' .$slug. 'tidak ditemukan');
		}

		return view('news/detail', $data);
	}

	public function create()
	{
		$data = [
			'title' => 'Form Add Data News',
			'validation' => \Config\Services::validation()
		];

		return view('news/create', $data);
	}

	public function save()
	{

		//validation input
		if(!$this->validate([
			'judul' => 'required|is_unique[news.judul]',
			'info' => 'required'

		])){
			
			return redirect()->to('/news/create')->withInput();
		}

		$slug = url_title($this->request->getVar('judul'), '-', true);
		$this->newsModel->save([
			'judul' => $this->request->getVar('judul'),
			'slug' => $slug,
			'info' => $this->request->getVar('info')
			]);

			session()->setFlashdata('pesan', 'Data berhasil ditambahkankan');

			return redirect()->to('/news');
	}

	public function delete($id)
	{
		//cari data berdasrkan id
		$news = $this->newsModel->find($id);

		$this->newsModel->delete($id);
		session()->setFlashdata('pesan', 'Data berhasil dihapus');

		return redirect()->to('/news');
	}


	public function edit($slug)
	{
		$data = [
			'title' => 'Form Edit Data News',
			'validation' => \Config\Services::validation(),
			'news' => $this->newsModel->getNews($slug)
		];

		return view('news/edit', $data);
	}

	public function update($id)
	{
		//cek judul
		$newslama = $this->newsModel->getNews($this->request->getVar('slug'));
		if ($newslama['judul'] == $this->request->getVar('judul')){
			$rule_judul = 'required';
		} else{
			$rule_judul = 'required|is_unique[news.judul]';
		}

		if(!$this->validate([
			'judul' => [
				'rules' => $rule_judul
			],
			'info' => 'required'
			
		])){
			
			return redirect()->to('/news/edit/' . $this->request->getVar('slug'))->withInput();
		}

		$slug = url_title($this->request->getVar('judul'), '-', true);
		$this->newsModel->save([
			'id' => $id,
			'judul' => $this->request->getVar('judul'),
			'slug' => $slug,
			'info' => $this->request->getVar('info')
			]);

			session()->setFlashdata('pesan', 'Data berhasil diedit');

			return redirect()->to('/news');
	}
}