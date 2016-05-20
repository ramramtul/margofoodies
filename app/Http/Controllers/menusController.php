<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class menusController extends CrudController{

    public function all($entity){
        parent::all($entity); 

        	$this->filter = \DataFilter::source(new \App\Menus());
			//$this->filter->add('categoryId','Category','select')->options(\App\Category::lists("name", "id")->all()); // Filter with Select List
			$this->filter->add('nama', 'Nama', 'text'); // Filter by String
			$this->filter->submit('search');
			$this->filter->reset('reset');
			$this->filter->build();

			$this->grid = \DataGrid::source($this->filter);

			$this->grid->add('id', 'id');
			$this->grid->add('nama', 'Nama');
			$this->grid->add('harga', 'Harga');
			$this->grid->add('id_restoran', 'Id_Restoran');
			$this->grid->add('kapasitas', 'Kapasitas');
			$this->grid->add('jenis', 'Jenis');
			$this->grid->add('kategori', 'Kategori');

			$this->grid->add('deskripsi', 'Deskripsi');
			$this->grid->add('id_photo', 'Id_Photo');
			$this->grid->add('rate', 'Rate');
			$this->grid->add('jumlah_tested', 'Jumlah_Tested');
			$this->grid->add('Is_Paket_Tanpa_Minum', 'is_Paket_Tanpa_Minum');
			$this->grid->add('Is_Paket_Dgn_Minum', 'is_Paket_Dgn_Minum');
			
			$this->addStylesToGrid();

			$this->grid->paginate(20);

			//$this->grid->add('name', 'Name', true); // allow ordering by this column
			$this->grid->orderBy('id','asc'); //default orderby
			$this->grid->add('nama', 'Nama', true);
			$this->grid->add('id', 'Id', true);
			$this->grid->add('harga', 'Harga', true);

                 
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

        	$this->edit = \DataEdit::source(new \App\Menus());

			$this->edit->label('Edit Menu');
			$this->edit->add('id', '', 'auto')->insertValue('1080000');

			//$this->edit->add('id', 'id', 'text');
			$this->edit->add('nama', 'Nama', 'text');
			$this->edit->add('harga', 'Harga', 'text');
			$this->edit->add('id_restoran', 'Id_Restoran', 'select')->options(\App\Restorans::lists("nama", "id")->all());
			$this->edit->add('kapasitas', 'Kapasitas', 'text');
			$this->edit->add('jenis', 'Jenis', 'select')->option('Makanan utama','Makanan utama')->option('Makanan penutup','Makanan penutup')->option('Cemilan','Cemilan')->option('Minuman','Minuman')->option('Other','Other');
			$this->edit->add('kategori', 'Kategori', 'select')->option('Indonesian','Indonesian')->option('Other','Other')->option('Asian','Asian')->option('Coffee','Coffee')->option('Western','Western')->option('Bakery','Bakery')->option('Japanese','Japanese');

			$this->edit->add('deskripsi', 'Deskripsi', 'text');
			$this->edit->add('id_photo', 'Id_Photo', 'text');
			$this->edit->add('rate', 'Rate', 'text');
			$this->edit->add('jumlah_tested', 'Jumlah_Tested', 'text');
			$this->edit->add('Is_Paket_Tanpa_Minum', 'is_Paket_Tanpa_Minum', 'radiogroup')->option('0', 'Tidak')->option('1', 'Ya');
			$this->edit->add('Is_Paket_Dgn_Minum', 'is_Paket_Dgn_Minum', 'radiogroup')->option('0', 'Tidak')->option('1', 'Ya');
       
        return $this->returnEditView();
    }    
}
