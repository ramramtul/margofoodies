<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class restoransController extends CrudController{

    public function all($entity){
        parent::all($entity); 

        $this->filter = \DataFilter::source(new \App\Restorans());
			$this->filter->add('nama', 'Nama', 'text'); // Filter dengan nama
			$this->filter->submit('search');
			$this->filter->reset('reset');
			$this->filter->build();

			$this->grid = \DataGrid::source($this->filter);

			$this->grid->add('id', 'id');
			$this->grid->add('nama', 'Nama');
			$this->grid->add('no_telepon', 'Telepon');
			$this->grid->add('lokasi', 'Lokasi');
			$this->grid->add('deskripsi', 'Deskripsi');
			$this->grid->add('tax', 'Tax');
			$this->grid->add('rate', 'Rate');
			
			$this->addStylesToGrid();

			$this->grid->paginate(10);

			$this->grid->orderBy('id','asc'); //urutkan berdasar waktu

                 
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

        	$this->edit = \DataEdit::source(new \App\Restorans());

			$this->edit->label('Edit Restoran');

			$this->edit->add('id', 'ID', 'text');

			$this->edit->add('nama', 'Nama', 'text');
		
			$this->edit->add('no_telepon', 'Telepon', 'text');

			$this->edit->add('lokasi', 'Lokasi', 'text');
		
			$this->edit->add('deskripsi', 'Deskripsi', 'text');

			$this->edit->add('tax', 'Tax', 'text');
		
			$this->edit->add('rate', 'Rate', 'text');
       
        return $this->returnEditView();
    }    
}
