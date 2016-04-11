@extends('layout')

@yield('title')
<title> MargoFoodies - Menu {{$restoran->nama}}</title>

@section('content')

@if(count($menus))
  <div class="container" >
  <h1 id="name"><b>MENU <a href="../restoran/{{$restoran->id}}">"{{strtoupper($restoran->nama)}}"</a></b></h1>  
  <br>
  <div class="row">
  <div class="col-xs-12 col-sm-6 col-md-3">
    <div class="panel panel-default">
          <div class="panel-body res2">
            <h3><b> FILTER <b></h3>
            
             <form role="form">
              <div class="radio">
                <h4><label><input type="radio" name="optradio">Filter 1</label></h4>
              </div>
              
              <div class="radio">
                <h4><label><input type="radio" name="optradio">Filter 2</label></h4>
              </div>
              
              <div class="radio">
                <h4><label><input type="radio" name="optradio">Filter 3</label></h4>
              </div>
              
              <div class="radio">
                <h4><label><input type="radio" name="optradio">Filter 4</label></h4>
              </div>
              
              <div class="radio">
                <h4><label><input type="radio" name="optradio">Filter 5</label></h4>
              </div>
              
              <div class="radio">
                <h4><label><input type="radio" name="optradio">Filter 6</label></h4>
              </div>
              
              <div class="radio">
                <h4><label><input type="radio" name="optradio">Filter 7</label></h4>
              </div>
              
            </form>
          </div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-6 col-md-9">
      <div class="row">
  <div class="col-xs-12 col-sm-6 col-md-12 ">
  {!! $menus->links() !!}
  </div>
  </div>
    @foreach($menus as $menu)
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
                <a href="#"><b>Lihat Review</b></a>
            </div>
          </div>
        </div>
      </div>
    @endforeach
    </div>
  </div>
@endif
@stop

