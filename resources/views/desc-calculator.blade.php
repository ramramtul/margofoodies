@extends('layout')

@section('title')
	<title>MargoFoodies - Kalkulator Patungan </title>
@stop

@section('content')
<?php
    use App\Pesanan;
    $jmlOrang = Session::get('jmlOrang');
    $resto = Session::get('resto');
    $user = Session::get('email');
    $jml = $jmlOrang + 1;
    $patungan = Pesanan::where('id_user', '=', $user)->where('id_orang', '=', $jml)->get();
    $totalPatungan = 0;
    $biayaPatungan = 0;
    $or = Session::get('or');
?>
@foreach($patungan as $pat)
    <?php
        $menu = App\Menu::find($pat->id_menu);
        $totalPatungan = $totalPatungan + ($menu->harga);
    ?>
@endforeach
    <?php
        $biayaPatungan = $totalPatungan/$jmlOrang;
    ?>

<!-- Bootstrap Boilerplate... -->
<div class="container">
    <h2> Ringkasan Patungan </h2>
  
        <h3> Restoran : {{ $resto->nama }}</h3>
        <h3> Untuk : {{ $jmlOrang }} ORANG</h3>
            <h3> Oleh : {{$user}}</h3>
    <div class="row">
        <div class="col-md-6"> 
        <div class="panel panel-default">
            <div class="panel-heading">
                Hasil Perhitungan
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
    @for ($i = 1; $i <= $jmlOrang; $i++)
    <tr> 
        <?php
            $pesanan = Pesanan::where('id_user', '=', $user)->where('id_orang', '=', $i)->get();
             $total = $biayaPatungan;
        ?>
        @foreach($pesanan as $pesan)
        <?php
            $menu = App\Menu::find($pesan->id_menu);
            $total = $total + ($menu->harga);
        ?>
        @endforeach
        <td> Orang ke {{$i}} </td>
        <td> Rp.{{$total}},00 </td>
        <td>
            
            
            <script>
           
            function onClick(id)
            {
                
                window.alert(id);
                <?php
                    
                ?>
                //location.reload();
            }
            </script>
            
                        <button type="submit" onclick="onClick(this.id)" id="{{ $i }}" class="btn btn-danger">
                Rincian
            </button>

        </td>
        </tr>
    @endfor
    </tbody>
    </table>
    </div>
        </div>
    </div>
    <div class="col-md-6"> 
        <div class="panel panel-default">
            <div class="panel-heading">
                Rincian Pesanan
            </div>

            <div class="panel-body" id="rincian">
            <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Pesanan</th>
                        <th>Harga</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody id="pesanan">
                    <?php
                        $pesanan = Pesanan::where('id_user', '=', $user)->where('id_orang', '=', $or)->get();
                        $totPes = 0;
                    ?>
                       @foreach($pesanan as $pesan)
                        <?php
                            $menu = App\Menu::find($pesan->id_menu);
                            $totPes = $totPes + $menu->harga;
                        ?>
                        <tr>
                         <td class="table-text">
                                    
                                    <div>{{$menu->nama}}</div>
                                </td>
                                <td class="table-text">
                                    
                                    <div>{{$menu->harga}}</div>
                                </td>
                                </tr>
                        @endforeach 
                        <tr>
                
                        <td class="table-text">
                        <div><b>Total</b></div>
                        </td>
                        <td class="table-text">
                                    
                                    <div>{{$totPes}}</div>
                                </td>
                        </tr>
                    </tbody>
            </table>
            <div>
            <hr>
                <b>Patungan</b>
                <hr>
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Pesanan</th>
                        <th>Harga</th>
                        <th>Harga per orang</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody id="patungan">
                    <?php
                        $totPat = 0;
                        $totP = 0;
                    ?>
                        @foreach($patungan as $pat)
                            <?php
                                $menu = App\Menu::find($pat->id_menu);
                                $hOrang = $menu->harga/$jmlOrang;
                                $totPat = $totPat + $hOrang;
                                $totP = $totP + $menu->harga;
                            ?>
                            <tr>
                            <td class="table-text">
                                    
                                    <div>{{$menu->nama}}</div>
                                </td>
                                <td class="table-text">
                                    
                                    <div>{{$menu->harga}}</div>
                                </td>
                                <td class="table-text">
                                    
                                    <div>{{$hOrang}}</div>
                                </td>
                            </tr>

                        @endforeach
                        <tr>
                
                        <td class="table-text">
                        <div><b>Total</b></div>
                        </td>
                         <td class="table-text">
                                    
                                    <div>{{$totP}}</div>
                                </td>
                        <td class="table-text">
                                    
                                    <div>{{$totPat}}</div>
                                </td>
                        </tr>
                    </tbody>
                </table>

            </div>



            </div>
    </div>
    </div>
    

    <!-- TODO: Current Tasks -->
@stop