@extends('layouts.Skydash')

@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card card-border">
        <div class="card-body">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('home')}}"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="{{url('paketsayaktg')}}">Paket Saya</a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="{{url('paketsayasubktg')}}/{{Crypt::encrypt($subkategori->fk_paket_kategori)}}">{{$subkategori->kategori_r->judul}}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{$subkategori->judul}}</li>
            </ol>
          </nav>
          <p class="card-description">
            <h3 class="font-weight-bold"><b>Pilih Paket</b></h3>
          </p>
          <div class="row mt-4">
            @forelse($paket as $key)
            <div class="col-md-4 grid-margin stretch-card">
              <a href="{{url('paketsayadetail')}}/{{Crypt::encrypt($key->id)}}" class="hrefpaket">
                <div class="card card-border">
                  <img src="{{url($key->banner)}}" alt="" style="width:100%;height:300px;object-fit:cover;border-top-left-radius: 20px;border-top-right-radius: 20px;">
                  <div class="card-body">
                    <h3><b>{{$key->judul}}</b></h3>
                    <h6>{{count($key->paket_dtl_r)}} Paket</h6>
                    <div class="mt-3">
                        @php
                          $cekdata = App\Models\Transaksi::where('fk_user_id',Auth::id())->where('status',1)->where('aktif_sampai','>=',Carbon\Carbon::now())->orderBy('aktif_sampai','desc')->first();
                        @endphp
                      <p>Berlaku hingga:<br>{{tglIndo($cekdata->aktif_sampai)}}</p>
                    </div>
                    <button class="mt-3 btn btn-lg btn-primary btn-block">Mulai Belajar</button>
                  </div>
                </div>
              </a>
            </div>
            @empty
            <center><img class="mb-3 img-no" src="{{asset('image/global/no-paket.png')}}" alt=""></center>
            <br>
            <center>Belum Ada Data</center>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer')
<!-- SweetAlert2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  // Initialize tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
  $(document).ready(function(){
    
  });
</script>
<!-- Loading Overlay -->
@endsection


