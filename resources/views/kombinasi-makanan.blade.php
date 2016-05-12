@extends('layout')

@section('title')
<title>MargoFoodies - Hasil Pencarian Makanan</title>
@stop

@section('content')

@if(count($menus))
<div class="container" >
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
        </div>
      </div>
      <nav>
        <ul class="pager">
          <li><a id="prev" href="#">Previous</a></li>
          <li><a id="page" href="#">page</a></li>
          <li><a id="next" href="#">Next</a></li>
        </ul>
      </nav>
      <?php $id=1; $length=sizeof($menus); ?>
      @foreach($menus as $menu)
      <div class="panel panel-default" id="{{ $id++ }}" style="display: none;">
        <div class="panel-body res1">
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4">
              <img src="/margofoodies/public/images/menu.jpg" class="img-responsive img-menu">
            </div>
            <div class="col-xs-12 col-sm-6 col-md-8">
              <h4><b>{{ $menu['nama_menu'] }}</b></h4>
              <h5> {{$menu['deskripsi']}} </h5>
              <h4 style="color: #EA5B4D;"> Rp.{{ $menu['harga'] }},00</h4>
              <h5> Restoran : {{$menu['nama_resto']}} </h5>
              <h5> Jenis : {{$menu['jenis']}} </h5>
              <h5> 
                <div class="star-ratings-sprite">
                  <span class="star-ratings-sprite-rating" style="width:{{$menu['rate_menu']}}%"></span></div>
                </h4>
                <h5><b> {{$menu['jumlah_tested']}} tasted </b></h5>
                <a href="#"><b>Lihat Review</b></a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>


    <script type="text/javascript">
      // Wait for the page to load first
      function update($page, $len) {
        $k = 10;

        if ($page > 0) {
          $("#prev").show();
        } else {
          $("#prev").hide();
        }

        if ($page+1 < ($len/10)) {
          $("#next").show();
        } else if ($len%10 == 0) {
          $("#next").hide();
        } else if ($page+1 == $len/10) {
          $("#next").show();
        } else {
          $("#next").hide();
          $k = $len%10;
        }


        var halaman = document.getElementById("page");
        halaman.innerHTML = ($page*10+1)+"-"+($page*10+$k)+" dari "+$len;
      }

      $(document).ready(function() {

        $len = {{ json_encode($length) }};
        for ($i=1; $i<11; $i++){
          $("#"+$i).show();
        }
        
        var prev = document.getElementById("prev");
        var next = document.getElementById("next");
        var halaman = document.getElementById("page");
        $page = 0;
        $("#prev").hide();
        if ($len > 10) {
          halaman.innerHTML = "1-10 dari "+$len;
        } else {
          halaman.innerHTML = "1-"+$len+" dari "+$len;
        }

        prev.onclick = function() { 
          for ($i = ($page*10)+1; $i<($page*10)+11; $i++) {
            $("#"+$i).hide();
          }
          $page--;
          for ($i = ($page*10)+1; $i<($page*10)+11; $i++) {
            $("#"+$i).show();
          }
          update($page,$len);
          return false;
        }
        next.onclick = function() {
          for ($i = ($page*10)+1; $i<($page*10)+11; $i++) {
            $("#"+$i).hide();
          }
          $page++;
          for ($i = ($page*10)+1; $i<($page*10)+11; $i++) {
            $("#"+$i).show();
          }
          update($page,$len);
          return false;
        }
      });
    </script>
    @endif

    @stop
