@extends('layouts.Adminlte3')

@section('header')
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('layout/adminlte3/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('layout/adminlte3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('layout/adminlte3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('layout/adminlte3/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('layout/adminlte3/dist/css/adminlte.min.css') }}">
  
@endsection

@section('contentheader')
<h1 class="m-0">Paket Latihan</h1>
@endsection

@section('contentheadermenu')
<ol class="breadcrumb float-sm-right">
    <!-- <li class="breadcrumb-item">Master</li> -->
    <li class="breadcrumb-item active">Paket Latihan</li>
</ol>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
              <span data-toggle="tooltip" data-placement="left" title="Tambah Data">
                <button data-toggle="modal" data-target="#modal-tambah" type="button" class="btn btn-sm btn-primary btn-add-absolute">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
              </span>
              <!-- <button data-toggle="modal" data-target="#modal-tambah" type="button" class="btn btn-md btn-primary btn-absolute">Tambah</button> -->
                <table id="tabledata" class="table  table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Jenis</th>
                    <th>Waktu Pengerjaan</th>
                    <th>Total Soal</th>
                    <!-- <th>Passing Grade</th> -->
                    <th>Detail</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($data as $key)
                  <tr>
                    <td width="1%">{{$loop->iteration}}</td>
                    <td width="20%">{{$key->judul}}</td>
                    <td width="5%" class="_align_center">{{jenissoalpilgan($key->tryout)}}</td>
                    <td width="1%" class="_align_center">{{$key->waktu}} Menit</td>
                    @php
                      $jumlahsoalpilgan = App\Models\PaketSoalDtl::where('fk_paket_soal_mst',$key->id)->get();
                      $jumlahsoalessay = App\Models\PaketSoalEssayDtl::where('fk_paket_soal_mst',$key->id)->get();
                      
                      if($jumlahsoalpilgan){
                        $jumlahsoalpilgan = count($jumlahsoalpilgan);
                      }else{
                        $jumlahsoalpilgan = 0;
                      }
                      
                      if($jumlahsoalessay){
                        $jumlahsoalessay = count($jumlahsoalessay);
                      }else{
                        $jumlahsoalessay = 0;
                      }
                    @endphp
                    <td width="1%" class="_align_center">
                      <span style="white-space:nowrap">{{$jumlahsoalpilgan}} Pilihan Ganda</span><br>
                      <span style="white-space:nowrap">{{$jumlahsoalessay}} Essay</span>
                    </td>
                    <!-- <td width="1%" class="_align_center">{{$key->kkm}}</td> -->
                    <!-- <td>{{$key->ket}}</td> -->
                    <td width="1%" class="_align_center">
                      <div class="btn-group">
                       
                     
                        <span data-toggle="tooltip" data-placement="left" title="Soal Pilihan Ganda [Kategori]">
                          <a href="{{url('paketsoalktg')}}/{{$key->id}}" class="btn btn-sm btn-outline-primary"><i class="fas fa-book"></i></a>
                        </span>
                        <span data-toggle="tooltip" data-placement="left" title="Soal Essay [Kategori]">
                          <a href="{{url('paketsoalessayktg')}}/{{$key->id}}" class="btn btn-sm btn-outline-primary"><i class="fas fa-book"></i></a>
                        </span>
                        
                        <span data-toggle="tooltip" data-placement="left" title="Download Soal">
                          <a target="_blank" href="{{url('exportsoal/pilgan')}}/{{Crypt::encrypt($key->id)}}" class="btn btn-sm btn-outline-success"><i class="fas fa-download"></i></a>
                        </span>
                        <span data-toggle="tooltip" data-placement="left" title="Nilai & Ranking Peserta">
                          <a href="{{url('rankingpeserta')}}/{{Crypt::encrypt($key->id)}}" class="btn btn-sm btn-outline-info"><i class="fas fa-trophy"></i></a>
                        </span>
                      </div>
                    </td>
                    <td width="1%" class="_align_center">
                      <div class="btn-group">
                        <span data-toggle="tooltip" data-placement="left" title="Ubah Data">
                          <button data-toggle="modal" data-target="#modal-edit-{{$key->id}}" type="button" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></button>
                        </span>
                        @php
                          $cekdata = App\Models\PaketDtl::where('fk_mapel_mst',$key->id)->where('jenis',1)->get();
                        @endphp
                        @if(count($cekdata)<=0)
                        <span data-toggle="tooltip" data-placement="left" title="Hapus Data">
                          <button data-toggle="modal" data-target="#modal-hapus-{{$key->id}}" type="button" class="btn btn-sm btn-outline-danger"><i class="far fa-trash-alt"></i></button>
                        </span>
                        @else
                          <span data-toggle="tooltip" data-placement="left" title="Harap hapus data pada paket terlebih dahulu">
                            <button type="button" class="btn btn-sm btn-outline-danger disabled"><i class="far fa-trash-alt"></i></button>
                          </span>
                        @endif
                      </div>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                  <!-- <tfoot>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                  </tfoot> -->
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    @foreach($data as $key)                   
    <!-- Modal Edit -->
    <div class="modal fade" id="modal-edit-{{$key->id}}">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Ubah Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" id="formData_{{$key->id}}" class="form-horizontal">
            @csrf
            <div class="modal-body">
              <!-- <div class="card-body"> -->
                <div class="form-group">
                    <label for="judul_{{$key->id}}">Judul<span class="bintang">*</span></label>
                    <input type="text" class="form-control" id="judul_{{$key->id}}" name="judul[]" placeholder="Judul" value="{{$key->judul}}">
                </div>

                <div class="form-group">
                    <label for="tryout_{{$key->id}}">Jenis Paket</label>
                    <select name="tryout[]" id="tryout_{{$key->id}}" class="jenistryout form-control" idwaktu="{{$key->id}}">
                      <option value="2" {{$key->tryout==2 ? "selected" : ""}}>Gratis</option>
                      <option value="0" {{$key->tryout==0 ? "selected" : ""}}>Berbayar</option>
                      <option value="1" {{$key->tryout==1 ? "selected" : ""}}>Tryout Akbar</option>
                    </select>
                </div>

                <div class="waktu_pengerjaan_{{$key->id}} {{$key->tryout==1 ? 'hide' : ''}}">
                  <div class="form-group">
                      <label for="waktu_{{$key->id}}">Waktu Pengerjaan (Menit)<span class="bintang">*</span></label>
                      <input type="text" class="form-control int" id="waktu_{{$key->id}}" name="waktu[]" placeholder="Waktu" value="{{$key->waktu}}">
                  </div>
                </div>

                <div class="waktu_tryout_{{$key->id}} {{$key->tryout==1 ? '' : 'hide'}}">
                  <label>Waktu<span class="bintang">*</span></label>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <input value="{{datetimeedit($key->mulai)}}" type="text" class="form-control waktu" name="mulai[]" id="mulai_{{$key->id}}" placeholder="Mulai"> 
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <input value="{{datetimeedit($key->selesai)}}" type="text" class="form-control waktu" name="selesai[]" id="selesai_{{$key->id}}" placeholder="Selesai"> 
                      </div>
                    </div>
                  </div>
                </div>

                <div class="kode_{{$key->id}} {{$key->tryout==1 ? '' : 'hide'}}">
                  <div class="form-group">
                      <label for="kode_{{$key->id}}">Kode<span class="bintang">*</span></label>
                      <input type="text" class="form-control" id="kode_{{$key->id}}" name="kode[]" placeholder="Kode" value="{{$key->kode}}">
                  </div>
                </div>
               
                <!-- <div class="form-group"> -->
                    <!-- <label for="kkm_{{$key->id}}">Passing Grade<span class="bintang">*</span></label> -->
                    <input type="hidden" class="form-control int" id="kkm_{{$key->id}}" name="kkm[]" placeholder="Passing Grade" value="{{$key->kkm}}">
                <!-- </div> -->
                <div class="form-group">
                  <label>Banner <span class="input-keterangan">(jpg/jpeg/png)</span></label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="input-foto custom-file-input" id="banner_{{$key->id}}" name="banner[]" idlabel="label-banner-{{$key->id}}">
                      <label id="label-banner-{{$key->id}}" class="custom-file-label" style="border-radius: .25rem;">Pilih file</label>
                    </div>
                  </div> 
                </div>
                <div class="form-group">
                  <label>Acak Soal<span class="bintang">*</span></label>
                  <br>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="acak_soal[]" value="1" {{$key->acak_soal==1 ? "checked" : ""}}>
                    <label class="form-check-label">Ya</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="acak_soal[]" value="0" {{$key->acak_soal==0 ? "checked" : ""}}>
                    <label class="form-check-label">Tidak</label>
                  </div>
                  <br>
                </div>
                <div class="form-group">
                  <label>Bagi Kunci Jawaban & Pembahasan<span class="bintang">*</span></label>
                  <br>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="bagi_jawaban[]" value="1" {{$key->bagi_jawaban==1 ? "checked" : ""}}>
                    <label class="form-check-label">Bagi</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="bagi_jawaban[]" value="0" {{$key->bagi_jawaban==0 ? "checked" : ""}}>
                    <label class="form-check-label">Jangan Bagi</label>
                  </div>
                  <br>
                </div>

                <!-- <div class="form-group">
                  <label>Sertifikat & Piagam<span class="bintang">*</span></label>
                  <br>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sertifikat[]" value="1" {{$key->sertifikat==1 ? "checked" : ""}}>
                    <label class="form-check-label">Ada</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sertifikat[]" value="0" {{$key->sertifikat==0 ? "checked" : ""}}>
                    <label class="form-check-label">Tidak Ada</label>
                  </div>
                  <br>
                </div> -->

                <!-- <div class="form-group">
                    <label for="pengumuman">Pengumuman</label>
                    <textarea name="pengumuman[]" id="pengumuman" rows="5" class="form-control content_" placeholder="Pengumuman">{!! $key->pengumuman !!}</textarea>  
                </div>  -->

                <div class="form-group">
                    <label for="ket_{{$key->id}}">Keterangan</label>
                    <textarea name="ket[]" id="ket_{{$key->id}}" rows="5" class="form-control content_" placeholder="Keterangan">{{$key->ket}}</textarea>  
                </div>  
                
              

               
                <!-- /.form-group -->
              <!-- </div> -->
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <label class="ket-bintang">Bertanda <span class="bintang">*</span> Wajib diisi</label>
                <button type="submit" class="btn btn-danger btn-submit-data" idform="{{$key->id}}">Simpan</button>
            </div>
          </form>
        </div>
      <!-- /.modal-content -->
      </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /.modal edit -->

    <!-- Modal Hapus -->
    <div class="modal fade" id="modal-hapus-{{$key->id}}">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Konfirmasi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" id="formHapus_{{$key->id}}" class="form-horizontal">
            @csrf
            <div class="modal-body">
                <h6> Apakah anda ingin menghapus paket latihan {{$key->judul}}?</h6>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger btn-hapus" idform="{{$key->id}}">Hapus</button>
            </div>
          </form>
        </div>
      <!-- /.modal-content -->
      </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /.Modal Hapus -->
@endforeach

<!-- Modal Tambah -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" id="_formData" class="form-horizontal">
          @csrf
          <div class="modal-body">
              <!-- <div class="card-body"> -->
              <div class="form-group">
                <label for="judul_add">Judul<span class="bintang">*</span></label>
                <input type="text" class="form-control" id="judul_add" name="judul_add" placeholder="Judul">
              </div>

              <div class="form-group">
                  <label for="tryout_add">Jenis Paket</label>
                  <select name="tryout_add" id="tryout_add" class="jenistryout form-control" idwaktu="add">
                    <option value=""></option>
                    <option value="2">Gratis</option>
                    <option value="0">Berbayar</option>
                    <option value="1">Tryout Akbar</option>
                  </select>
              </div>

              <div class="waktu_tryout_add hide">
                <label>Waktu<span class="bintang">*</span></label>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <input type="text" class="form-control waktu" name="mulai_add" id="mulai_add" placeholder="Mulai"> 
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <input type="text" class="form-control waktu" name="selesai_add" id="selesai_add" placeholder="Selesai"> 
                    </div>
                  </div>
                </div>
              </div>

              <div class="kode_add hide">
                <div class="form-group">
                  <label for="kode_add">Kode<span class="bintang">*</span></label>
                  <input type="text" class="form-control" id="kode_add" name="kode_add" placeholder="Kode">
                </div>
              </div>

              <div class="waktu_pengerjaan_add hide">
                <div class="form-group">
                  <label for="waktu_add">Waktu Pengerjaan (Menit)<span class="bintang">*</span></label>
                  <input type="text" class="form-control int" id="waktu_add" name="waktu_add" placeholder="Waktu" value="0">
                </div>
              </div>
              <!-- <div class="form-group"> -->
                <!-- <label for="kkm_add">Passing Grade<span class="bintang">*</span></label> -->
                <input type="hidden" class="form-control int" id="kkm_add" name="kkm_add" placeholder="Passing Grade" value="50">
              <!-- </div> -->

              <div class="form-group">
                <label>Banner<span class="bintang">*</span> <span class="input-keterangan">(jpg/jpeg/png)</span></label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="input-foto custom-file-input" id="banner_add" name="banner_add" idlabel="label-banner-add">
                    <label id="label-banner-add" class="custom-file-label" style="border-radius: .25rem;">Pilih file</label>
                  </div>
                </div> 
              </div>  

              <div class="form-group">
                  <label>Acak Soal<span class="bintang">*</span></label>
                  <br>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="acak_soal_add" value="1" checked>
                    <label class="form-check-label">Ya</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="acak_soal_add" value="0">
                    <label class="form-check-label">Tidak</label>
                  </div>
                  <br>
              </div>

              <div class="form-group">
                  <label>Bagi Kunci Jawaban & Pembahasan<span class="bintang">*</span></label>
                  <br>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="bagi_jawaban_add" value="1" checked>
                    <label class="form-check-label">Bagi</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="bagi_jawaban_add" value="0">
                    <label class="form-check-label">Jangan Bagi</label>
                  </div>
                  <br>
              </div>

              <!-- <div class="form-group">
                  <label>Sertifikat & Piagam<span class="bintang">*</span></label>
                  <br>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sertifikat_add" value="1" checked>
                    <label class="form-check-label">Ada</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sertifikat_add" value="0">
                    <label class="form-check-label">Tidak Ada</label>
                  </div>
                  <br>
              </div> -->

              <!-- <div class="form-group">
                    <label for="pengumuman_add">Pengumuman</label>
                    <textarea name="pengumuman_add" id="pengumuman_add" rows="2" class="form-control content_" placeholder="Pengumuman"></textarea>
                </div> -->

              <div class="form-group">
                <label for="ket_add">Keterangan</label>
                    <textarea name="ket_add" id="ket_add" rows="5" class="form-control content_" placeholder="Keterangan"></textarea>  
              </div>

            
              <!-- <div class="card-body"> -->
              <!-- /.form-group -->
            <!-- </div> -->
          </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <label class="ket-bintang">Bertanda <span class="bintang">*</span> Wajib diisi</label>
              <button type="submit" class="btn btn-danger">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal edit -->

@endsection

@section('footer')
<!-- Custom Input File -->
<script src="{{ asset('layout/adminlte3/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- jQuery -->
<script src="{{ asset('layout/adminlte3/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('layout/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jquery-validation -->
<script src="{{ asset('layout/adminlte3/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('layout/adminlte3/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('layout/adminlte3/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('layout/adminlte3/dist/js/demo.js') }}"></script>
<!-- Page specific script -->
<!-- DatePicker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/themes/dark.css">
<!--  Flatpickr  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
<!-- Tinymce -->
<script src="https://cdn.tiny.cloud/1/6yq8fapml30gqjogz5ilm4dlea09zn9rmxh9mr8fe907tqkj/tinymce/4/tinymce.min.js"></script>
<script>
  $(document).ready(function(){

    $('.jenistryout').select2({
      placeholder: "Pilih Jenis Paket"
    });
    
    $(".hide").hide();

    $(document).on('change', '.jenistryout', function (e) {
        jenis = $(this).val();
        idwaktu = $(this).attr('idwaktu');
        $(".waktu_tryout_"+idwaktu).hide();
        $(".kode_"+idwaktu).hide();
        $(".waktu_pengerjaan_"+idwaktu).hide();
        if(jenis==1){
          $(".waktu_tryout_"+idwaktu).show();
          $(".kode_"+idwaktu).show();
        }else{
          $(".waktu_pengerjaan_"+idwaktu).show();
        }
    });

    // bsCustomFileInput.init();
    datatablemapelmst("tabledata");
    
    bsCustomFileInput.init();

    tinymce.init({
        selector: ".content_", theme: "modern",
        plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons paste textcolor"
        ],
        toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
        toolbar2: " | link unlink anchor | image media | forecolor backcolor  | print preview code ",
        image_advtab: true,
        height : "250",
        file_picker_callback: function (cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');

        /*
          Note: In modern browsers input[type="file"] is functional without
          even adding it to the DOM, but that might not be the case in some older
          or quirky browsers like IE, so you might want to add it to the DOM
          just in case, and visually hide it. And do not forget do remove it
          once you do not need it anymore.
        */

        input.onchange = function () {
          var file = this.files[0];

          var reader = new FileReader();
          reader.onload = function () {
            /*
              Note: Now we need to register the blob in TinyMCEs image blob
              registry. In the next release this part hopefully won't be
              necessary, as we are looking to handle it internally.
            */
            var id = 'blobid' + (new Date()).getTime();
            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
            var base64 = reader.result.split(',')[1];
            var blobInfo = blobCache.create(id, file, base64);
            blobCache.add(blobInfo);

            /* call the callback and populate the Title field with the file name */
            cb(blobInfo.blobUri(), { title: file.name });
          };
          reader.readAsDataURL(file);
        };

        input.click();
      }
    });

    $(document).on('change', '.input-foto', function (e) {
        var idphoto = $(this).attr('id');
        onlyPhoto(idphoto);
    });

    $(".waktu").flatpickr({
        enableTime: true,
        dateFormat: "d-m-Y H:i",
        disableMobile: "true",
        time_24hr: true
    });

    $(".int").on('input paste', function () {
      hanyaInteger(this);
    });

    $(".jenis_penilaian").on('change', function () {
      value = $(this).val();
      idkkm = $(this).attr('idkkm');
      if(value==1){
        $("#"+idkkm).attr('max','100');
      }else{
        $("#"+idkkm).removeAttr('max');
      }
    });

    //Fungsi Hapus Data
    $(document).on('click', '.btn-hapus', function (e) {
        idform = $(this).attr('idform');
        var formData = new FormData($('#formHapus_' + idform)[0]);

        var url = "{{ url('/hapuspaketsoalmst') }}/"+idform;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: 'POST',
            dataType: "JSON",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $.LoadingOverlay("show");
            },
            success: function (response) {
                    if (response.status == true) {
                      Swal.fire({
                          html: response.message,
                          icon: 'success',
                          showConfirmButton: false
                        });
                        reload(1000);
                    }else{
                      Swal.fire({
                          html: response.message,
                          icon: 'error',
                          confirmButtonText: 'Ok'
                      });
                    }
            },
            error: function (xhr, status) {
                alert('Error!!!');
            },
            complete: function () {
                $.LoadingOverlay("hide");
            }
        });
    });
    

    // Fungsi Ubah Data
    $(document).on('click', '.btn-submit-data', function (e) {
        idform = $(this).attr('idform');
        $('#formData_'+idform).validate({
          rules: {
            'judul[]': {
              required: true
            },
            'bagi_jawaban[]': {
              required: true
            },
            'sertifikat[]': {
              required: true
            },
            'mulai[]': {
              required: true
            },
            'selesai[]': {
              required: true
            },
            'waktu[]': {
              required: true,
              min:1
            },
            'kkm[]': {
              required: true,
              min:1
            },
            'tryout[]': {
              required: true
            },
            'kode[]': {
              required: true
            }
          },
          messages: {
            'judul[]': {
              required: "Judul tidak boleh kosong"
            },
            'bagi_jawaban[]': {
              required: "Bagi jawaban tidak boleh kosong"
            },
            'sertifikat[]': {
              required: "Sertifikat tidak boleh kosong"
            },
            'mulai[]': {
              required: "Mulai tidak boleh kosong"
            },
            'selesai[]': {
              required: "Selesai tidak boleh kosong"
            },
            'waktu[]': {
              required: "Waktu pengerjaan tidak boleh kosong",
              min:"Waktu pengerjaan tidak boleh kosong"
            },
            'kkm[]': {
              required: "Passing grade tidak boleh kosong",
              min:"Passing grade tidak boleh kosong",
              max:"Maximal 100"
            },
            'tryout[]': {
              required: "Jenis paket tidak boleh kosong"
            },
            'kode[]': {
              required: "Kode tidak boleh kosong"
            },
          },
          errorPlacement: function (error, element) {
            if (element.hasClass('_select2')) {     
                element.parent().addClass('select2-error');
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            } else {                                      
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            }
          },
          highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
            if(element.tagName.toLowerCase()=='select'){
              var x = element.getAttribute('id');
              y = $('#'+x).parent().addClass('select2-error');
            }
          },
          unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            if(element.tagName.toLowerCase()=='select'){
              var x = element.getAttribute('id');
              y = $('#'+x).parent().removeClass('select2-error');
            }
          },

          submitHandler: function () {
          
            var formData = new FormData($('#formData_'+idform)[0]);

            var url = "{{ url('/updatepaketsoalmst') }}/"+idform;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: 'POST',
                dataType: "JSON",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $.LoadingOverlay("show");
                },
                success: function (response) {
                    if (response.status == true) {
                      Swal.fire({
                          html: response.message,
                          icon: 'success',
                          showConfirmButton: false
                        });
                        reload(1000);
                    }else{
                      Swal.fire({
                          html: response.message,
                          icon: 'error',
                          confirmButtonText: 'Ok'
                      });
                    }
                },
                error: function (xhr, status) {
                    alert('Error!!!');
                },
                complete: function () {
                    $.LoadingOverlay("hide");
                }
            });   
          }
        });
    });

    // Fungsi Add Data
    $('#_formData').validate({
          rules: {
            judul_add: {
              required: true
            },
            bagi_jawaban_add: {
              required: true
            },
            sertifikat_add: {
              required: true
            },
            waktu_add: {
              required: true,
              min:1
            },
            kkm_add: {
              required: true,
              min:1
            },
            kode_add: {
              required: true
            },
            banner_add: {
              required: true
            },
            mulai_add: {
              required: true
            },
            selesai_add: {
              required: true
            },
            tryout_add: {
              required: true
            }
          },
          messages: {
            judul_add: {
              required: "Judul tidak boleh kosong"
            },
            bagi_jawaban_add: {
              required: "Bagi jawaban tidak boleh kosong"
            },
            sertifikat_add: {
              required: "Sertifikat tidak boleh kosong"
            },
            waktu_add: {
              required: "Waktu tidak boleh kosong",
              min:"Waktu pengerjaan tidak boleh kosong"
            },
            kkm_add: {
              required: "Passing grade tidak boleh kosong",
              min:"Passing grade tidak boleh kosong",
              max:"Maximal 100"
            },
            kode_add: {
              required: "Kode tidak boleh kosong"
            },
            banner_add: {
              required: "Banner tidak boleh kosong"
            },
            mulai_add: {
              required: "Mulai tidak boleh kosong"
            },
            selesai_add: {
              required: "Selesai tidak boleh kosong"
            },
            tryout_add: {
              required: "Jenis paket tidak boleh kosong"
            }
          },
          errorElement: 'span',
          errorPlacement: function (error, element) {
            if (element.hasClass('_select2')) {     
                element.parent().addClass('select2-error');
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            } else {                                      
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            }
          },
          highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
            if(element.tagName.toLowerCase()=='select'){
              var x = element.getAttribute('id');
              y = $('#'+x).parent().addClass('select2-error');
            }
          },
          unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            if(element.tagName.toLowerCase()=='select'){
              var x = element.getAttribute('id');
              y = $('#'+x).parent().removeClass('select2-error');
            }
          },

          submitHandler: function () {
          
            var formData = new FormData($('#_formData')[0]);

            var url = "{{ url('storepaketsoalmst') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: 'POST',
                dataType: "JSON",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $.LoadingOverlay("show");
                },
                success: function (response) {
                    if (response.status == true) {
                        Swal.fire({
                          html: response.message,
                          icon: 'success',
                          showConfirmButton: false
                        });
                        reload(1000);
                    }else{
                      Swal.fire({
                          html: response.message,
                          icon: 'error',
                          confirmButtonText: 'Ok'
                      });
                    }
                },
                error: function (xhr, status) {
                    alert('Error!!!');
                },
                complete: function () {
                    $.LoadingOverlay("hide");
                }
            });   
          }
      });

  });
</script>

@endsection