@extends('layout')

@section('title')
  <title>MargoFoodies - Hasil Pencarian</title>
@stop

@section('content')
  <div class="container">
  <h1><b>HASIL PENCARIAN "{{$query}}"</b></h1>
  @if(count($menu))
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-12 ">
        {!! $menu->render() !!}
      </div>
    </div>
    @foreach ($menu as $hasil)
      <div class="panel panel-default">
        <div class="panel-body res1">
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4">
              <img src="images/menu.jpg" class="img-responsive img-menu">
            </div>
            <div class="col-xs-12 col-sm-6 col-md-8">
              <h4><b>{{$hasil->nama}}</b></h4>
              <h5><b><a href="restoran/{{$hasil->id_restoran}}">{{$hasil->resto}}</a></b></h5>
              <h5> {{$hasil->deskripsi}} </h5>
              <h4 style="color: #EA5B4D;"> Rp {{$hasil->harga}},00</h4>
              <h5> Jenis Masakan : {{$hasil->kategori}} </h5>
              <h5> Kategori : {{$hasil->jenis}} </h5>
              <div class="star-ratings-sprite">
                <span class="star-ratings-sprite-rating" style="width:{{$hasil->rat}}%"></span></div>
              <h5><b> {{$hasil->jumlah_tested}} tasted </b></h5>
              <a href="#"><b>Lihat Review</b></a>
            </div>
            <br>
          </div>
        </div>
      </div>
    @endforeach
  @else
    <div class="container">
      <h2>Tidak ditemukan menu "{{$query}}"</h2>
    </div>
  @endif
  </div>
@stop

