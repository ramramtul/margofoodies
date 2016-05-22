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
			$this->addStylesToGrid();

			$this->grid->paginate(10);

			//$this->grid->add('name', 'Name', true); // allow ordering by this column
			$this->grid->orderBy('id','asc'); //default orderby
			$this->grid->add('judul', 'Judul', true);
			$this->grid->add('id', 'Id', true);
			
		


        
                 
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);
        	$this->edit = \DataEdit::source(new \App\Promos());

			$this->edit->label('Edit Promo');
			$results = \App\Promos::all()->first() ;
			if(empty($results)){
				$this->edit->add('id', '', 'auto')->insertValue(1);
			}else{
				$results = \App\Promos::all()->last()->id;
				$this->edit->add('id', '', 'auto')->insertValue($results + 1);
			}
			$this->edit->add('judul', 'Judul', 'text');
			$this->edit->add('deskripsi', 'Deskripsi', 'text');
			$this->edit->add('tgl_berlaku_awal', 'pub.date', 'date')->format('y-m-d', 'it');
			$this->edit->add('tgl_berlaku_akhir', 'pub.date', 'date')->format('y-m-d', 'it');
			$this->edit->add('id_restoran', 'Id_Restoran', 'select')->options(\App\Restorans::lists("nama", "id")->all());
			$this->edit->add('photo', 'Photo', 'image')->move('uploads/images/');
			
       
       
        return $this->returnEditView();
    }    
}
