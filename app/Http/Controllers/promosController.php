<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class promosController extends CrudController{

    public function all($entity){
        parent::all($entity); 
        	$this->filter = \DataFilter::source(new \App\Promos());
			//$this->filter->add('categoryId','Category','select')->options(\App\Category::lists("name", "id")->all()); // Filter with Select List
			$this->filter->add('judul', 'Judul', 'text'); // Filter by String
			$this->filter->submit('search');
			$this->filter->reset('reset');
			$this->filter->build();

			$this->grid = \DataGrid::source($this->filter);

			$this->grid->add('id', 'id');
			$this->grid->add('judul', 'Judul');
			$this->grid->add('deskripsi', 'Deskripsi');
			$this->grid->add('tgl_berlaku_awal', 'Tanggal Berlaku Awal');
			$this->grid->add('tgl_berlaku_akhir', 'Tanggal Berlaku Akhir');
			$this->grid->add('id_restoran', 'Id Restoran');
			$this->grid->add('id_photo', 'Id Photo');
			$this->grid->orderBy('id','asc'); //default orderby


        /** Simple code of  filter and grid part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields


			$this->filter = \DataFilter::source(new \App\Category);
			$this->filter->add('name', 'Name', 'text');
			$this->filter->submit('search');
			$this->filter->reset('reset');
			$this->filter->build();

			$this->grid = \DataGrid::source($this->filter);
			$this->grid->add('name', 'Name');
			$this->grid->add('code', 'Code');
			$this->addStylesToGrid();

        */
                 
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);
        	$this->edit = \DataEdit::source(new \App\Promos());

			$this->edit->label('Edit Promo');
			$this->edit->add('id', '', 'auto')->insertValue('3653');

			//$this->edit->add('id', 'id', 'text');
			$this->edit->add('nama', 'Nama', 'text');
			$this->edit->add('harga', 'Harga', 'text');

       
       
        return $this->returnEditView();
    }    
}
