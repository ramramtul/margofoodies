@extends('layout')

@section('title')
<title> MargoFoodies - Review Menu</title>
@stop

@section('content')
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
                <span class="star-ratings-sprite-rating" style="width:{{$menu->rate}}%"></span>
              </div>
              </h5>
              <h5><b> {{$menu->jumlah_tested}} tasted </b></h5>
            </div>
          </div>
        </div>
      </div>

      <h4><b>Berikan review untuk {{$menu->nama}}</b></h4>
      <form class="form-horizontal" role="form" action="../createReview/{{$menu->id}}" method="POST">
      {!! csrf_field() !!}
        <div class="form-group">
            <label class="col-sm-2" for="rate">Rating:</label>
              <select class="form-control" name='rate' id="rate">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select> 
          </div>
        <div class="form-group">
          <div class="col-sm-10">
            <textarea class="form-control" name="isi" id="isi" placeholder="Masukkan review Anda"></textarea>
          </div>  
        </div>
        <button onclick="myFunction()" type="submit" class="btn btn-default" >Kirim</button>
          <script>
          function myFunction() {
              alert("Terimakasih telah mereview! Review kamu akan diverifikasi oleh pihak margofoodies terlebih dahulu sebelum di publish :)")
            }
          </script>

      </form>
      <br>
      @if(count($review))
        <h4><b>Review untuk menu ini</b></h4>
        @foreach ($review as $review)
          <div class="panel panel-default">
            <div class="panel-body res3">
              <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-8">
                  <h4><b>{{$review->email}}</b> memberikan nilai <b>{{$review->rate}}/5</b></h4>
                  <h5> "{{$review->isi_review}}"" </h5>
                </div>
                <br>
              </div>
            </div>
          </div>
        @endforeach
      @else
        <h4><b>Belum ada review untuk menu ini</b></h4>
      @endif
    </div>
    
@stop