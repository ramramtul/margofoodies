@extends('layout')

@section('title')
	<title>MargoFoodies - Kalkulator Patungan </title>
@stop

@section('content')
<?php
    use App\Pesanan;
    $orang = Session::get('orang');
    $jmlOrang = Session::get('jmlOrang');
    $resto = Session::get('resto');
    $menus = Session::get('menus');
    $user = Session::get('email');
    $pesanan = Pesanan::where('id_user', '=', $user)->where('id_orang', '=', $orang)->get();
    $jml = $jmlOrang + 1;

?>
<!-- Bootstrap Boilerplate... -->
<div class="container">
<h2 class="judul"> Kalkulator Patungan </h2>
  
        <h3> Restoran : {{ $resto->nama }}</h3>
        <h3> Untuk : {{ $jmlOrang }} ORANG</h3>
        @if ($orang == $jml)
            <h3> Oleh : {{$user}} - Pesanan Bersama</h3>
        @else
            <h3> Oleh : {{$user}} - Pesanan Orang ke {{$orang}}</h3>
        @endif
<div style="text-align: right;">
        <?php
        $prev = $orang - 1;
        $next = $orang + 1;
        $link = url("calculateFood");
        if($prev >= 1){
            echo "<a href='$link/$prev'><button class='btn btn-danger'> Previous </button></a>";
        } 
        echo "&nbsp;&nbsp;&nbsp;";
        if($next <= $jml){
            echo "<a href='$link/$next'><button class='btn btn-danger'> Next </button></a>";
        } 
        $a = 1;
        
    ?>
    </div>
    <div class="panel-body">
        <!-- Display Validation Errors -->
        <!-- New Task Form -->
       
        <form action="{{ url('calculateFood')/$orang }}" method="POST" class="form-horizontal">
            {!! csrf_field() !!}

            <!-- Task Name -->
            <div class="form-group">
                <label for="task-name" class="col-sm-3 control-label">Pesanan</label>

                <div class="col-sm-6">
                    {!! Form::select('nama', $menus, null, ['name' => 'menu', 'class' => 'form-control']) !!}
                   
                </div>
            </div>

            <!-- Add Task Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Tambah Pesanan
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- Current Tasks -->
    @if (count($pesanan) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Pesanan Sekarang
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Pesanan</th>
                        <th>Harga</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
       
                        @foreach ($pesanan as $pesan)
                            <tr>
                                <!-- Task Name -->
                                <?php
    								$menu = App\Menu::find($pesan->id_menu);

    							?>	

                                <td class="table-text">
                                	
                                    <div>{{$menu->nama}}</div>
                                </td>
                                <td class="table-text">
                                	
                                    <div>{{$menu->harga}}</div>
                                </td>

                                 <!-- Delete Button -->
		    					<td>
    
			        				<form action="{{ url('calculateFood')/$orang }}" method="POST">
			            {{ csrf_field() }}
			            {{ method_field('DELETE') }}
    
			            <button type="submit" name="pesanan" value="{{ $pesan->id_pesanan }}" class="btn btn-danger">
                <i class="fa fa-btn fa-trash"></i>Delete
            </button>
			        </form>
		    </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    @endif
    

    @if($orang == $jml)
    

    @endif
 <button class="btn btn-danger" data-toggle="modal" data-target="#myModal">
            Hitung
        </button>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Hitung Patungan</h4>
              </div>
              <div class="modal-body">
              <p> Setelah ini Anda tidak dapat lagi mengubah pesanan, Apakah anda yakin?</p>
              </div>
              <div class="modal-footer">
                <div style="text-align: center">
              <table>
              <tr>
          
                <td><form action="{{ url('calculate/'.$a.'')}}" method="POST">

    
                        <td><button type="submit" name="hitung" value="hitung" class="btn btn-danger btn-responsive">
                <i class="fa fa-btn fa-trash"></i>Ya
            </button>
                    </form></td>
                <td><button type="button" class="btn btn-danger btn-responsive" data-dismiss="modal">Tidak</button></td>
                

               </tr>
                </table>
                </div>
              </div>
            </div>
          </div>
        </div>
</div>
@stop