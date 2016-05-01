@extends('layout')

@section('title')
<title> MargoFoodies - Review Menu</title>
@stop

@section('content')
@if(count($review))
    <div class="container">
      <h1><b>REVIEW</b></h1>
      <div class="panel panel-default">
            <div class="panel-body res1">
              <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <img src="../images/menu.jpg" class="img-responsive img-menu" alt={{$restoran->nama}}>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-8">
                    <h4><b>{{$menu->nama}}</b></h4>
                    <h5> {{$menu->deskripsi}} </h5>
                    <h4 style="color: #EA5B4D;"> Rp.{{$menu->harga }},00</h4>
                    <h5> Jenis Masakan : {{$menu->kategori}} </h5>
                    <h5> Kategori : {{$menu->jenis}} </h5>
                    <h5> 
                    <div class="star-ratings-sprite">
                      <span class="star-ratings-sprite-rating" style="width:{{$menu->rate}}%"></span></div>
                    </h4>
                    <h5><b> {{$menu->jumlah_tested}} tasted </b></h5>
                    <a href="../review/{{$menu->id}}"><b>Lihat Review</b></a>
                </div>
              </div>
            </div>
          </div>
        @foreach ($review as $review)
          <div class="panel panel-default">
            <div class="panel-body res1">
              <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-8">
                  <h4><b>{{$review->email}}</b></h4>
                  <h5> {{$review->isi_review}} </h5>
                </div>
                <br>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  @else
    Ga ada bego
  @endif
@stop