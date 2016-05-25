<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class usersController extends CrudController{

    public function all($entity){
        parent::all($entity); 

       $this->filter = \DataFilter::source(new \App\Users());
       		$this->filter->add('nama_lengkap', 'nama_lengkap', 'text'); // Filter by String
			$this->filter->submit('search');
			$this->filter->reset('reset');
			$this->filter->build();
			//$this->grid->add('nama_lengkap', 'Nama Lengkap');
			$this->grid = \DataGrid::source($this->filter);
			$this->grid->add('email', 'email');

        	

			//$this->grid = \DataGrid::source($this->filter);

			
			
			$this->addStylesToGrid();

			$this->grid->paginate(10);

		


                 
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

        $this->edit = \DataEdit::source(new \App\Users());
        $this->edit->add('isClient', 'isClient', 'radiogroup')->option('0', 'Tidak')->option('1', 'Ya');
       
       
        return $this->returnEditView();
    }    
}
