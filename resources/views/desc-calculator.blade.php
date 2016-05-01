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
    $tax = $resto->tax;
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
    <h2 class="judul"> Ringkasan Patungan </h2>
        <div style="text-align: center;">
            <h4> Restoran : <b>{{ $resto->nama }} </b> -   untuk : <b>{{ $jmlOrang }} orang</b></h4>
            <br>
        </div>
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
                                    <?php
                                        $pajak = ($tax/100)*$total;
                                        $totalTagihan=$total+$pajak;
                                    ?>
                                    <td> Orang ke {{$i}} </td>
                                    <td> Rp.{{$totalTagihan}},00 </td>
                                    <td>
                                        
                                        <form action="{{ url('calculate/'.$i.'')}}" method="POST">
                                                    {{ csrf_field() }}
                                                    <button type="submit"  id="{{ $i }}" class="btn btn-danger">
                                            Rincian
                                        </button>
                                        </form>

                                    </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
                <form action="{{ url('calculate')}}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit"  class="btn btn-danger">
                        Selesai
                    </button>
                </form>
            </div>

            <div class="col-md-6"> 
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Rincian Pesanan Orang ke {{$or}}
                    </div>
                    <?php
                        $pesanan = Pesanan::where('id_user', '=', $user)->where('id_orang', '=', $or)->get();
                        $totPes = 0;
                    ?>       
                    <div class="panel-body" id="rincian">
                        @if(count($pesanan) > 0)
                            <table class="table table-striped task-table">
                                <!-- Table Headings -->
                                <thead>
                                    <th>Orang</th>
                                    <th>Tagihan</th>
                                    <th>&nbsp;</th>
                                </thead>

                                <!-- Table Body -->
                                <tbody id="pesanan">
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
                                                <div>Rp.{{$menu->harga}},00</div>
                                            </td>
                                        </tr>
                                    @endforeach 
                                    <tr>
                                        <td class="table-text">
                                            <div><b>Total</b></div>
                                        </td>
                                        <td class="table-text">
                                            <div>Rp.{{$totPes}},00</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif
                        <hr>
    
                        <b>Patungan</b>
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
                                        $hOrang = round($menu->harga/$jmlOrang, 2);
                                        $totPat = $totPat + $hOrang;
                                        $totP = $totP + $menu->harga;
                                    ?>
                                    <tr>
                                        <td class="table-text">
                                            <div>{{$menu->nama}}</div>
                                        </td>
                                        <td class="table-text">
                                            <div>Rp.{{$menu->harga}},00</div>
                                        </td>
                                        <td class="table-text">
                                            <div>Rp.{{$hOrang}},00</div>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="table-text">
                                        <div><b>Total</b></div>
                                    </td>
                                    <td class="table-text">
                                        <div>Rp.{{$totP}},00</div>
                                    </td>
                                    <td class="table-text">
                                        <div>Rp.{{$totPat}},00</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped task-table">
                            <!-- Table Headings -->
                            <thead>
                                <th>Besar tax</th>
                                <th>Biaya Pesanan</th>
                                <th>Tax</th>
                                <th>Total Tagihan</th>
                            </thead>

                            <!-- Table Body -->
                            <tbody id="patungan">
                                <tr>
                                    <td class="table-text">
                                        <div>{{$tax}}%</div>
                                    </td>
                                    <td class="table-text">
                                        <div>Rp.{{$total}},00</div>
                                    </td>
                                    <td class="table-text">
                                        <div>Rp.{{$pajak}},00</div>
                                    </td>
                                    <td class="table-text">
                                        <div>Rp.{{$totalTagihan}},00</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>   

@stop