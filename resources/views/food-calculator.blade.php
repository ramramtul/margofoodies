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
	<h2> Kalkulator Patungan </h2>
  
        <h3> Restoran : {{ $resto->nama }}</h3>
		<h3> Untuk : {{ $jmlOrang }} ORANG</h3>
        @if ($orang == $jml)
            <h3> Oleh : {{$user}} - Pesanan Bersama</h3>
        @else
            <h3> Oleh : {{$user}} - Pesanan Orang ke {{$orang}}</h3>
        @endif
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
    <?php
        $prev = $orang - 1;
        $next = $orang + 1;
        $link = url("calculateFood");
        if($prev >= 1){
            echo "<a href='$link/$prev'> Previous </a>";
        } 
        if($next <= $jml){
            echo "<a href='$link/$next'> Next </a>";
        } 
            
        
    ?>
    @if($orang == $jml)
       
            <form action="{{ url('calculate')}}" method="POST">
                        {{ csrf_field() }}
    
                        <button type="submit" name="hitung" value="hitung" class="btn btn-danger">
                <i class="fa fa-btn fa-trash"></i>Hitung
            </button>
                    </form>
    @endif
</div>
    <!-- TODO: Current Tasks -->
@stop