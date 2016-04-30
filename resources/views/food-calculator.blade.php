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
<div class="container kalkulator">
    <h2 class="judul"> Kalkulator Patungan </h2>
  <div class="panel panel-default">
        <div class="panel-body res2">
        <div style="text-align: center;">
        <h4> Restoran : <b>{{ $resto->nama }} </b> -   untuk : <b>{{ $jmlOrang }} orang</b></h4>
        @if ($orang == $jml)
            <h4><b>Pesanan Bersama</b></h4>
        @else
            <h4><b>Pesanan Orang ke {{$orang}}</b></h4>
        @endif
        </div>
    <div class="row">
        <div class="col-xs-3 col-xs-offset-9">
             <?php
                $prev = $orang - 1;
                $next = $orang + 1;
                $link = url("calculateFood");
                if($prev >= 1){
                    echo "<a href='$link/$prev'><button class='btn btn-danger'><i class='fa fa-arrow-left'></i>  Previous </button></a>";
                } 
                echo "&nbsp;&nbsp;&nbsp;";
                if($next <= $jml){
                    echo "<a href='$link/$next'><button class='btn btn-danger'><i class='fa fa-arrow-right'></i>  Next </button></a>";
                }

                $a = 1;
                    
                
            ?>
        </div>
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
                    <button type="submit" class="btn btn-danger">
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
                                    
                                    <div>Rp.{{$menu->harga}},00</div>
                                </td>

                                 <!-- Delete Button -->
                                <td>
    
                                    <form action="{{ url('calculateFood')/$orang }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
    
                        <button type="submit" name="pesanan" value="{{ $pesan->id_pesanan }}" class="btn btn-danger">
                <i class="fa fa-trash-o"></i> Delete
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
        <form action="{{ url('calculate/'.$a.'')}}" method="POST">
            {{ csrf_field() }}

            <button type="submit" name="hitung" value="hitung" class="btn btn-danger">
            <i class="fa fa-btn fa-trash"></i>Hitung
             </button>
        </form>
        <br>
        <br>
    @endif
    </div>
    </div>
</div>
    <!-- TODO: Current Tasks -->
@stop