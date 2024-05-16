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
  <script src="https://kit.fontawesome.com/f121295e13.js" crossorigin="anonymous"></script>
  <style>
    p{
      margin-bottom:0rem;
    }
    .modal-body{
      padding-bottom:0px;
    }
    .table{
      margin-bottom:0px;
    }
    .form-group{
      margin-bottom:0px;
    }
  </style>
@endsection

@section('contentheader')
<h1 class="m-0">Nilai & Ranking Peserta</h1>
@endsection

@section('contentheadermenu')
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a class="_kembali" href="{{url('paketsoalmst')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a></li>
</ol>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- <div class="card-header">
                <h3 class="card-title">Foto Beranda</h3>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
                <!-- <div>
                  <button data-toggle="modal" data-target="#modal-tambah" type="button" class="btn btn-md btn-primary">
                    Ingatkan Peserta
                  </button>
                </div> -->
              <!-- <button data-toggle="modal" data-target="#modal-tambah" type="button" class="btn btn-md btn-primary btn-absolute">Tambah</button> -->
                <table id="tabledata" class="table  table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Tgl.Mengerjakan</th>
                    <!-- <th>Provinsi</th> -->
                    <th>Nilai Pilihan Ganda</th>
                    <th>Nilai Essay</th>
                    <th>Total Nilai</th>
                    <!-- <th>Predikat</th> -->
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($udatapaket as $key)
                  <tr class="{{$key->status==1 ? 'table-success' : 'table-danger'}}">
                    <td width="1%">{{$loop->iteration}}</td>
                    <td width="25%">{{$key->user_r->name}}</td>
                    <td width="5%">{{Carbon\Carbon::parse($key->mulai)->translatedFormat('l, d F Y , H:i:s')}}</td>
                    <td width="5%" class="_align_right">{{$key->point}}</td>
                    <td width="5%" class="_align_right">{{$key->nilai}}</td>
                    <td width="5%" class="_align_right">{{$key->set_nilai}}</td>
                    <!-- <td width="5%" class="_align_center">{{$key->set_predikat}}</td> -->
                    <td width="1%" class="_align_center">
                      <div class="btn-group">
                        @if(count($key->u_paket_soal_essay_dtl_r)>0)
                        <span data-toggle="tooltip" data-placement="left" title="Nilai Essay">
                          <button data-toggle="modal" data-target="#modal-dataessay-{{$key->id}}" type="button" class="btn btn-sm btn-success"><i class="fas fa-spell-check"></i></button>
                        </span>
                        @endif
                        <span data-toggle="tooltip" data-placement="left" title="Detail Hasil">
                          <a target="_blank" href="{{url('detailhasil')}}/{{Crypt::encrypt($key->id)}}" type="button" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        </span>
                        <span data-toggle="tooltip" data-placement="left" title="{{$key->status==1 ? 'Jangan Tampil' : 'Tampil'}}">
                          <!-- <button data-toggle="modal" data-target="#modal-edit-{{$key->id}}" type="button" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></button> -->
                          @if($key->status==1)
                          <button iddata="{{$key->id}}" status="0" type="button" class="btn btn-sm btn-warning btn_ubah_status"><i class="fa fa-close" aria-hidden="true"></i></button>
                          @else
                          <button iddata="{{$key->id}}" status="1" type="button" class="btn btn-sm btn-warning btn_ubah_status"><i class="fa fa-check" aria-hidden="true"></i></button>
                          @endif
                        </span>
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
                Keterangan
                <br>
                <span><span class="badge rounded-pill bg-success">Hijau</span> : Tampil</span>
                <br>
                <span><span class="badge rounded-pill bg-danger">Merah</span> : Tidak Tampil</span>
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
    @foreach($udatapaket as $key)                   
    <!-- Modal Edit -->
    <div class="modal fade" id="modal-edit-{{$key->id}}">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tampil</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" id="formData_{{$key->id}}" class="form-horizontal">
            @csrf
            <input type="hidden" value="{{$key->id}}" name="id_data[]">
            <div class="modal-body">
              <!-- <div class="card-body"> -->
                <!-- <div class="form-group">
                    <label for="set_nilai_{{$key->id}}">Set Point<span class="bintang">*</span></label>
                    <input type="text" class="form-control int" id="set_nilai_{{$key->id}}" name="set_nilai[]" placeholder="Set Point" value="{{$key->set_nilai}}">
                </div>     -->
                <!-- <div class="form-group">
                  <label for="set_predikat_{{$key->id}}">Set Predikat<span class="bintang">*</span></label>
                  <select class="select-predikat form-control" name="set_predikat[]" id="set_predikat_{{$key->id}}">
                    <option value=""></option>
                    <option value="A+" {{$key->set_predikat=="A+" ? "selected" : ""}}>A+</option>
                    <option value="A" {{$key->set_predikat=="A" ? "selected" : ""}}>A</option>
                    <option value="B+" {{$key->set_predikat=="B+" ? "selected" : ""}}>B+</option>
                    <option value="B" {{$key->set_predikat=="B" ? "selected" : ""}}>B</option>
                  </select>
                </div>   -->
                <div class="form-group">
                  <label for="status_{{$key->id}}">Tampil<span class="bintang">*</span></label>
                  <select class="status form-control" name="status[]" id="status_{{$key->id}}">
                    <option value=""></option>
                    <option value="1" {{$key->status=="1" ? "selected" : ""}}>Ya</option>
                    <option value="0" {{$key->status=="0" ? "selected" : ""}}>Tidak</option>
                  </select>
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

        <!-- Modal Nilai Essay -->
        <div class="modal fade" id="modal-dataessay-{{$key->id}}">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Nilai Essay</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form method="post" id="formDataEssay_{{$key->id}}" class="form-horizontal">
                @csrf
                <input type="hidden" value="{{$key->id}}" name="id_data[]">
                @foreach($key->u_paket_soal_essay_dtl_r as $dataessay)
                    <div class="modal-body">
                      <div class="form-group">
                          <table class="table table-borderless">
                            <tbody>
                              <tr>
                                <td width="1%">{{$loop->iteration}}</td>
                                <td>{!!$dataessay->soal!!}</td>
                                <td width="1%"></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td>
                                  <h6><b>Jawaban Peserta :</b></h6>
                                  @if($dataessay->jawaban_user)
                                  {!!$dataessay->jawaban_user!!}
                                  @else
                                  -
                                  @endif
                                  @if($dataessay->jawaban_userfile)
                                  <br><br>
                                  <h6><b>File Jawaban Peserta:</b></h6>
                                  <a href="{{asset($dataessay->jawaban_userfile)}}">File Jawaban</a>
                                  @endif
                                </td>
                                <td width="1%"></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td>
                                  <h6><b>Kunci Jawaban :</b></h6>
                                  {!!$dataessay->jawaban!!}
                                </td>
                                <td width="1%"></td>
                              </tr>
                              <tr>
                                <td width="1%"></td>
                                <td>
                                  <h6>Beri Nilai<span class="bintang">*</span></h6>
                                  <input type="text" class="form-control int" id="nilai_{{$dataessay->id}}" name="nilai_{{$dataessay->id}}" placeholder="Nilai" value="{{$dataessay->nilai}}">
                                </td>
                                <td width="1%"></td>
                              </tr>
                            </tbody>
                          </table>
                      </div>
                    </div>
                    <!-- <hr> -->
                  @endforeach
                  <div class="modal-body">
                    <table class="table table-borderless" style="margin-bottom:2rem">
                      <tbody>
                        <tr>
                          <td width="1%">-</td>
                          <td>
                            <div class="form-group">
                              <label for="status_{{$key->id}}">Tampil<span class="bintang">*</span></label>
                              <select class="status form-control" name="status[]">
                                <option value=""></option>
                                <option value="1" {{$key->status=="1" ? "selected" : ""}}>Ya</option>
                                <option value="0" {{$key->status=="0" ? "selected" : ""}}>Tidak</option>
                              </select>
                            </div>
                          </td>
                          <td width="1%"></td>
                        </tr>
                        </tbody>
                    </table>
                  </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <label class="ket-bintang">Bertanda <span class="bintang">*</span> Wajib diisi</label>
                    <button type="submit" class="btn btn-danger btn-submit-data-dataessay" idform="{{$key->id}}">Simpan</button>
                </div>
              </form>
            </div>
          <!-- /.modal-content -->
          </div>
        <!-- /.modal-dialog -->
        </div>
        <!-- /.modal edit -->
    @endforeach

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
<script>
  $(document).ready(function(){

      tablerankingpeserta("tabledata");
      
      $(".int").on('input paste', function () {
        hanyaInteger(this);
      });

      $('.select-predikat').select2({
        placeholder: "Set Predikat"
      });

      $('.status').select2({
        placeholder: "Status"
      });

      // Fungsi Ubah Data
      $(document).on('click', '.btn-submit-data-dataessay', function (e) {
          idform = $(this).attr('idform');
          $('#formDataEssay_'+idform).validate({
            rules: {
              'id_data[]': {
                required: true
              }
            },
            messages: {
              'id_data[]': {
                required: "ID Data tidak boleh kosong"
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
            
              var formData = new FormData($('#formDataEssay_'+idform)[0]);

              var url = "{{ url('/updatenilaiessay') }}/"+idform;
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

      // Fungsi Ubah Data
      $(document).on('click', '.btn-submit-data', function (e) {
          idform = $(this).attr('idform');
          $('#formData_'+idform).validate({
            rules: {
              'set_nilai[]': {
                required: true
              },
              'set_predikat[]': {
                required: true
              }
            },
            messages: {
              'set_nilai[]': {
                required: "Set point tidak boleh kosong"
              },
              'set_predikat[]': {
                required: "Set predikat tidak boleh kosong"
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
            
              var formData = new FormData($('#formData_'+idform)[0]);

              var url = "{{ url('/updateranking') }}/"+idform;
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

      // Fungsi Ubah Status
      $(document).on('click', '.btn_ubah_status', function (e) {
        status = $(this).attr('status');
        iddata = $(this).attr('iddata');

        var url = "{{ url('/updatestatusranking') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: "POST",
              data:{
                iddata: iddata,
                status: status
              },
              dataType: "json",
              cache: false,
            beforeSend: function () {
                $.LoadingOverlay("show");
            },
            success: function (response) {
                    if (response.status == true) {
                      // Swal.fire({
                      //     html: response.message,
                      //     icon: 'success',
                      //     showConfirmButton: false
                      //   });
                        reload(0);
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

  });
</script>

@endsection