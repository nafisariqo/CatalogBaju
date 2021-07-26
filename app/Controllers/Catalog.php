<?php

namespace App\Controllers;

use App\Models\CatalogModel;

class Catalog extends BaseController
{
	protected $catalogModel;
	public function __construct()
	{
		$this->catalogModel = new CatalogModel();
	}

	public function index()
	{
		//d($this->request->getVar('keyword'));
		$currentPage = $this->request->getVar('page_catalog') ? $this->request->getVar('page_catalog') : 1;

		$keywoard = $this->request->getVar('keyword');
		if($keywoard){
			$ctlg = $this->catalogModel->search($keywoard);
		}else{
			$ctlg = $this->catalogModel;
		}
		
		//$catalog = $this->catalogModel->findAll();

        $data = [
            'title' => 'Catalog For Women',
			// 'catalog' => $this->catalogModel->findAll(),
			//'catalog' => $this->catalogModel->paginate(3, 'catalog'),
			'catalog' => $ctlg->paginate(3, 'catalog'),
			'pager' => $this->catalogModel->pager,
			'currentPage' => $currentPage
        ];


        // echo view('layout/header', $data);
		return view('catalog/index', $data);
		// echo view('layout/footer');
	}

	public function detail($slug)
	{
		$data = [
			'title' => 'Detail Catalog',
			'catalog' => $this->catalogModel->getCatalog($slug)
		];

		//jika catalog tidak ada ditabel
		if (empty($data['catalog'])){
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul catalog' .$slug. 'tidak ditemukan');
		}

		return view('catalog/detail', $data);
	}

	public function create()
	{
		//session();
		$data = [
			'title' => 'Form Add Data Catalog',
			'validation' => \Config\Services::validation()
		];

		return view('catalog/create', $data);
	}

	public function save()
	{

		//validation input
		if(!$this->validate([
			'judul' => 'required|is_unique[catalog.judul]',
			'deskripsi' => 'required',
			'gambar' => [
				'rules' => 'max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
				'errors'=> [
					'max_size' => 'ukuran gambar terlalu besar',
					'is_image' => 'yang anda pilih bukan gambar',
					'mime_in' => 'yang anda pilih bukan gambar'
				]
			]
		])){
			//$validation = \Config\Services::validation();
			//return redirect()->to('/catalog/create')->withInput()->with('validation', $validation);
			return redirect()->to('/catalog/create')->withInput();
		}

		// ambil gambar
		$fileGambar = $this->request->getFile('gambar');
		//apakah tidak ada gambar yang diupload
		if($fileGambar->getError() == 4){
			$namaGambar = 'logo.jpg';
		} else {
			//ambil nama file
			$namaGambar = $fileGambar->getName();
			//pindahkan file ke folder img
			$fileGambar->move('img', $namaGambar);

		}

		$slug = url_title($this->request->getVar('judul'), '-', true);
		$this->catalogModel->save([
			'judul' => $this->request->getVar('judul'),
			'slug' => $slug,
			'deskripsi' => $this->request->getVar('deskripsi'),
			'gambar' => $namaGambar
			]);

			session()->setFlashdata('pesan', 'Data berhasil ditambahkankan');

			return redirect()->to('/catalog');
	}

	public function delete($id)
	{
		//cari gambar berdasrkan id
		$catalog = $this->catalogModel->find($id);

		//cek jika file gambar default
		if($catalog['gambar'] != 'logo.jpg'){
			
			//hapus beneran si gambar biar ga menuhin server
			unlink('img/' . $catalog['gambar']);
		}


		$this->catalogModel->delete($id);
		session()->setFlashdata('pesan', 'Data berhasil dihapus');

		return redirect()->to('/catalog');
	}


	public function edit($slug)
	{
		$data = [
			'title' => 'Form Edit Data Catalog',
			'validation' => \Config\Services::validation(),
			'catalog' => $this->catalogModel->getCatalog($slug)
		];

		return view('catalog/edit', $data);
	}

	public function update($id)
	{
		//cek judul
		$cataloglama = $this->catalogModel->getCatalog($this->request->getVar('slug'));
		if ($cataloglama['judul'] == $this->request->getVar('judul')){
			$rule_judul = 'required';
		} else{
			$rule_judul = 'required|is_unique[catalog.judul]';
		}

		if(!$this->validate([
			'judul' => [
				'rules' => $rule_judul
			],
			'deskripsi' => 'required',
			'gambar' => [
				'rules' => 'max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
				'errors'=> [
					'max_size' => 'ukuran gambar terlalu besar',
					'is_image' => 'yang anda pilih bukan gambar',
					'mime_in' => 'yang anda pilih bukan gambar'
				]
			]
		])){
			
			return redirect()->to('/catalog/edit/' . $this->request->getVar('slug'))->withInput();
		}

		$fileGambar = $this->request->getFile('gambar');

		//cek gambar, apakah tetap gambar lama
		if($fileGambar->getError() == 4){
			$namaGambar = $this->request->getVar('gambarLama');
		} else {
			//ambil nama file
			$namaGambar = $fileGambar->getName();
			//pindahkan file ke folder img
			$fileGambar->move('img', $namaGambar);
			//hapus file yang lama
			unlink('img/' . $this->request->getVar('gambarLama'));

		}


		$slug = url_title($this->request->getVar('judul'), '-', true);
		$this->catalogModel->save([
			'id' => $id,
			'judul' => $this->request->getVar('judul'),
			'slug' => $slug,
			'deskripsi' => $this->request->getVar('deskripsi'),
			'gambar' => $namaGambar
			]);

			session()->setFlashdata('pesan', 'Data berhasil diedit');

			return redirect()->to('/catalog');
	}
}