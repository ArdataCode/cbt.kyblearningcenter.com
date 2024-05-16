@extends('layouts.Skydash')
<!-- partial -->
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card card-border">
        <div class="card-body">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('home')}}"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item active" aria-current="page">Paket Saya</li>
              <li class="breadcrumb-item active" aria-current="page">Kerjakan Latihan {{$upaketsoalmst->judul}}</li>
            </ol>
          </nav>
          <p class="card-description">
            <h3 class="font-weight-bold"><b>Latihan {{$upaketsoalmst->judul}}</b></h3>
          </p>
          
          <div class="row mt-3">
            <div class="col-xl-9 col-md-9 col-sm-9 col-xs-9">
            <div class="_soal_content tab-content" id="pills-tabContent">
              @foreach($upaketsoalmst->u_paket_soal_dtl_r as $key)
              <div class="tab-pane fade {{$key->no_soal==1 ? 'show active' : ''}}" id="pills-{{$key->no_soal}}" role="tabpanel">
                  <!-- <h4 class="ktg-soal">Kategori {{$key->u_paket_soal_ktg_r->judul}}</h4> -->
                  <!-- <h6><b>[{{$key->nama_tingkat}}]</b></h6> -->
                  <div class="mb-3 p-3 card-border" style="border-radius: 10px;">
                    <div class="row">
                      <div class="col-6">
                        <h4 class="mb-0 mt-2"><b>Soal No.{{$key->no_soal}} [Pilihan Ganda]</b></h4>
                      </div>
                      <div class="col-6">
                      </div>
                    </div>
                    <hr>
                    <div class="_soal">{!!$key->soal!!}</div>
                    <div class="form-group">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input _radio" nosoal="{{$key->no_soal}}" idpaketdtl="{{$key->id}}" name="radio_{{$key->id}}" value="a" {{$key->jawaban_user=="a" ? "checked='checked'" : ""}}>
                          <i class="input-helper"></i></label>
                          <div class="_pilihan">
                            <span><b>a.</b> </span>
                            <div class="_pilihan_isi">
                              {!!$key->a!!}
                            </div>
                          </div>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input _radio" nosoal="{{$key->no_soal}}" idpaketdtl="{{$key->id}}" name="radio_{{$key->id}}" value="b" {{$key->jawaban_user=="b" ? "checked" : ""}}>
                          <i class="input-helper"></i></label>
                          <div class="_pilihan">
                            <span><b>b.</b> </span>
                            <div class="_pilihan_isi">
                              {!!$key->b!!}
                            </div>
                          </div>
                      </div>
                      @if($key->c)
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input _radio" nosoal="{{$key->no_soal}}" idpaketdtl="{{$key->id}}" name="radio_{{$key->id}}" value="c" {{$key->jawaban_user=="c" ? "checked" : ""}}>
                          <i class="input-helper"></i></label>
                          <div class="_pilihan">
                            <span><b>c.</b> </span>
                            <div class="_pilihan_isi">
                              {!!$key->c!!}
                            </div>
                          </div>
                      </div>
                      @endif
                      @if($key->d)
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input _radio" nosoal="{{$key->no_soal}}" idpaketdtl="{{$key->id}}" name="radio_{{$key->id}}" value="d" {{$key->jawaban_user=="d" ? "checked" : ""}}>
                          <i class="input-helper"></i></label>
                          <div class="_pilihan">
                            <span><b>d.</b> </span>
                            <div class="_pilihan_isi">
                              {!!$key->d!!}
                            </div>
                          </div>
                      </div>
                      @endif
                      @if($key->e)
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input _radio" nosoal="{{$key->no_soal}}" idpaketdtl="{{$key->id}}" name="radio_{{$key->id}}" value="e" {{$key->jawaban_user=="e" ? "checked" : ""}}>
                          <i class="input-helper"></i></label>
                          <div class="_pilihan">
                            <span><b>e.</b> </span>
                            <div class="_pilihan_isi">
                              {!!$key->e!!}
                            </div>
                          </div>
                      </div>
                      @endif
                    </div>
                  </div>
                  <div style="padding-bottom:30px">
                    <span>
                      @if ($key->no_soal!=1)
                      <button idsoal="{{$key->no_soal - 1}}" type="button" class="btn-next-back btn btn-sm btn-primary btn-rounded btn-fw">
                        <i class="ti-back-left btn-icon-prepend"></i>                                                    
                        Sebelumnya
                      </button>
                      @endif
                    </span>
                    <span style="float:right;padding-bottom:30px">
                      @if ($key->no_soal!=$upaketsoalmst->total_soal)
                      <button idsoal="{{$key->no_soal + 1}}" type="button" class="btn-next-back btn btn-sm btn-primary btn-rounded btn-fw">
                        Selanjutnya
                        <i class="ti-back-right btn-icon-prepend"></i>                                                    
                      </button>
                      @endif
                    </span>
                  </div>
              </div>
              <!-- <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">2</div> -->
              @endforeach


              @foreach($upaketsoalmst->u_paket_soal_essay_dtl_r as $key)
              <div class="tab-pane fade {{$key->no_soal==1 ? 'show active' : ''}}" id="pills-{{$key->no_soal}}" role="tabpanel">
                  <!-- <h4 class="ktg-soal">Kategori {{$key->u_paket_soal_ktg_r->judul}}</h4> -->
                  <!-- <h6><b>[{{$key->nama_tingkat}}]</b></h6> -->
                  <div class="mb-3 p-3 card-border" style="border-radius: 10px;">
                    <div class="row">
                      <div class="col-6">
                        <h4 class="mb-0 mt-2"><b>Soal No.{{$key->no_soal}} [Essay]</b></h4>
                      </div>
                      <div class="col-6">
                      </div>
                    </div>
                    <hr>
                    <div class="_soal">{!!$key->soal!!}</div>
                    <br>
                    <div class="form-group">
                      <label><b>Jawaban :</b></label>
                      <textarea class="form-control _jawabessay" nosoal="{{$key->no_soal}}" idpaketdtl="{{$key->id}}" rows="10">{{$key->jawaban_user}}</textarea>
                    </div>
               
                    <form method="post" id="formData_{{$key->no_soal}}" class="form-horizontal">
                      @csrf
                      <!-- Terakhir -->
                      <input type="hidden" name="idpaketdtl[]" value="{{$key->id}}">
                      <div class="form-group">
                        <label><b>Upload File Jawaban</b> (xls | xlsx | pdf | png | jpg | jpeg | mp4 | mp3) :</label>
                        <input type="file" name="jawabanessayfile[]" class="_jawabessayfile form-control-file" nosoal="{{$key->no_soal}}" idpaketdtl="{{$key->id}}">
                      </div>
                    </form>
                    <div id="lihatfilejawaban_{{$key->no_soal}}">
                      @if($key->jawaban_userfile)
                      <a target="_blank" href="{{asset($key->jawaban_userfile)}}">Lihat File Jawaban Sebelumnya</a>
                      @endif
                    </div>
                  </div>
                  <div style="padding-bottom:30px">
                    <span>
                      @if ($key->no_soal!=1)
                      
                      <button idsoal="{{$key->no_soal - 1}}" type="button" class="btn-next-back btn btn-sm btn-primary btn-rounded btn-fw">
                        <i class="ti-back-left btn-icon-prepend"></i>                                                    
                        Sebelumnya
                      </button>
                      @endif
                    </span>
                    <span style="float:right;padding-bottom:30px">
                      @if ($key->no_soal!=$upaketsoalmst->total_soal)
                      <button idsoal="{{$key->no_soal + 1}}" type="button" class="btn-next-back btn btn-sm btn-primary btn-rounded btn-fw">
                        Selanjutnya
                        <i class="ti-back-right btn-icon-prepend"></i>                                                    
                      </button>
                      @endif
                    </span>
                  </div>
              </div>
              <!-- <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">2</div> -->
              @endforeach


            </div>
            </div>
            <div class="col-xl-3 col-md-3 col-sm-3 col-xs-3">
            <div class="mb-4 card-border p-3 div-waktu">
              <div class="mb-0" id="end">
                <h6>Waktu Tersisa</h6>
                <span class="f-waktu" id="hours"></span><br>
                <span class="f-waktu" id="mins"></span>
                <span class="f-waktu" id="secs"></span>
              </div>
            </div>

            <div class="mb-4 card-border p-3 br-10">
              <center class="mb-1">Sudah Selesai?</center>
              <button type="button" data-bs-toggle="modal" data-bs-target="#modalselesaiujian" class="btn-block btn btn-primary btn-sm _btn_selesai_ujian">
                <h6 class="mb-0">Selesaikan Ujian</h6>
              </button>
            </div>

            <div class="card-border p-3 br-10">
              <center class="mb-3">Nomor Soal</center>
              <ul class="_soal nav nav-pills mb-0" id="pills-tab" role="tablist">
                @foreach($upaketsoalmst->u_paket_soal_dtl_r as $key)
                <!-- <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">1</button>
                </li> -->
                <li class="nav-item" role="presentation">
                  <button id="btn_no_soal_{{$key->no_soal}}" class="btn-sm {{$key->jawaban_user ? '_ada_isi' : ''}} nav-link {{$key->no_soal==1 ? 'active' : ''}}" data-bs-toggle="pill" data-bs-target="#pills-{{$key->no_soal}}" type="button" role="tab" aria-selected="true">{{$key->no_soal}}</button>
                </li>
                @endforeach

                @foreach($upaketsoalmst->u_paket_soal_essay_dtl_r as $key)
                <!-- <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">1</button>
                </li> -->
                <li class="nav-item" role="presentation">
                  <button id="btn_no_soal_{{$key->no_soal}}" class="btn-sm {{$key->jawaban_user || $key->jawaban_userfile ? '_ada_isi' : ''}} nav-link {{$key->no_soal==1 ? 'active' : ''}}" data-bs-toggle="pill" data-bs-target="#pills-{{$key->no_soal}}" type="button" role="tab" aria-selected="true">{{$key->no_soal}}</button>
                </li>
                @endforeach
              </ul>
            </div>

            </div>
          </div>


        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalselesaiujian">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <!-- <div class="modal-header">
        <h4 class="modal-title">Selesaikan Ujian?</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div> -->

      <!-- Modal body -->
      <div class="modal-body pb-0">
        <center style="font-size:18px"><i style="color:#106571" class="fa fa-check-square"></i> <span style="color:#106571" class="modal-title"><b>Submit Jawaban Sekarang?</b></span></center>
        <h5 class="mt-2"><center>Jawaban yang telah disubmit tidak dapat diubah?</center></h5>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer" style="display:block;text-align: center;border-top:0px solid">
        <button type="button" class="btn btn-primary" id="btn-selesai" upaketsoalmst="{{Crypt::encrypt($upaketsoalmst->id)}}">Submit</button>
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>

    </div>
  </div>
</div>
@endsection

@section('footer')
<!-- jQuery -->
<!-- SweetAlert2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- jquery-validation -->
<script src="{{ asset('layout/adminlte3/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/jquery-validation/additional-methods.min.js') }}"></script>

<script>
  // window.onbeforeunload = function() {
  //     return "Yakin ingin keluar dari halaman ini!";
  // };
  $(document).ready(function(){

      $(document).bind("contextmenu",function(e){
        return false;
      });

      $('body').on("cut copy paste",function(e) {
          e.preventDefault();
      });

      $(document).on('click', '.btn-next-back', function (e) {
          idsoal = $(this).attr('idsoal');
          $('.tab-pane').removeClass('show active');
          $('.nav-link').removeClass('active');

          $('#pills-'+idsoal).addClass('show active');
          $('#btn_no_soal_'+idsoal).addClass('active');
      });

      $(document).on('change', '._radio', function (e) {
          jawaban = $(this).val();
          idpaketdl = $(this).attr('idpaketdtl');
          nosoal = $(this).attr('nosoal');
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: "{{url('updatejawaban')}}",
                async: false,
                data: {
                  jawaban : jawaban,
                  idpaketdl : idpaketdl
                },
                beforeSend: function () {
                    // $.LoadingOverlay("show", {
                    //     image       : "{{asset('/image/global/loading.gif')}}"
                    // });
                },
                success: function(response)
                {
                  if (response.status) {
                      $('#btn_no_soal_'+nosoal).addClass('_ada_isi');
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
                      // $.LoadingOverlay("hide");
                  }
              });
      });

      $(document).on('change', '._jawabessay', function (e) {
          jawaban = $(this).val();
          idpaketdl = $(this).attr('idpaketdtl');
          nosoal = $(this).attr('nosoal');
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: "{{url('updatejawabanessay')}}",
                async: false,
                data: {
                  jawaban : jawaban,
                  idpaketdl : idpaketdl
                },
                beforeSend: function () {
                    // $.LoadingOverlay("show", {
                    //     image       : "{{asset('/image/global/loading.gif')}}"
                    // });
                },
                success: function(response)
                {
                  if (response.status) {
                      if(jawaban==""){
                        $('#btn_no_soal_'+nosoal).removeClass('_ada_isi');
                      }else{
                        $('#btn_no_soal_'+nosoal).addClass('_ada_isi');
                      }
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
                      // $.LoadingOverlay("hide");
                  }
              });
      });

      $(document).on('change', '._jawabessayfile', function (e) {
          // jawaban = $(this).val();
          // idpaketdl = $(this).attr('idpaketdtl');
          nosoal = $(this).attr('nosoal');
          
          jQuery.validator.addMethod('fileSizeLimit', function(value, element, limit) {
              return !element.files[0] || (element.files[0].size <= limit);
          }, 'File is too big');

          $('#formData_'+nosoal).validate({
          rules: {
            'jawabanessayfile[]': {
              required: true,
              extension: "xls|xlsx|pdf|png|jpg|jpeg|mp4|mp3",
              fileSizeLimit: 5242880 // <- 5 MB
            }
          },
          messages: {
            'jawabanessayfile[]': {
              required: "File tidak boleh kosong",
              extension: "Ekstension file tidak sesuai",
              fileSizeLimit: "Max 5 MB"
            }
          },
          errorElement: 'span',
          errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
          },
          highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
          },
          unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
          },

          submitHandler: function () {
                var formData = new FormData($('#formData_'+nosoal)[0]);
                var url = "{{ url('updatejawabanessayfile') }}";
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
                        $.LoadingOverlay("show", {
                          image       : "{{asset('/image/global/loading.gif')}}"
                        });
                    },
                    success: function (response) {
                      if (response.status) {
                        $('#btn_no_soal_'+nosoal).addClass('_ada_isi');
                        Swal.fire({
                            html: response.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $("#lihatfilejawaban_"+nosoal).html('<a target="_blank" href="'+response.link+'">Lihat File</a>')
                        // console.log(response.link);
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

          $('#formData_'+nosoal).submit();

      });

      $(document).on('click', '#btn-selesai', function (e) {
          idpaketmst = $('#btn-selesai').attr('upaketsoalmst');
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: "{{url('selesaiujian')}}",
                async: false,
                data: {
                  idpaketmst : idpaketmst
                },
                beforeSend: function () {
                    $.LoadingOverlay("show", {
                        image       : "{{asset('/image/global/loading.gif')}}"
                    });
                },
                success: function(response)
                {
                  if (response.status) {
                      
                      $('.modal').modal('hide');
                      document.getElementById("end").innerHTML = "UJIAN SELESAI!!";
                        Swal.fire({
                            html: response.message,
                            icon: 'success',
                            showConfirmButton: true
                        }).then((result) => {
                            $.LoadingOverlay("show", {
                              image       : "{{asset('/image/global/loading.gif')}}"
                            });
                            reload_url(1500,response.menu);
                        })

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

      // COUNDOWN
      // The data/time we want to countdown to
      var countDownDate = new Date("{{$upaketsoalmst->selesai}}").getTime();

      // Run myfunc every second
      i = 0;
      var myfunc = setInterval(function() {

      const now = new Date('{{$now}}');
      now.setSeconds(now.getSeconds() + i);
      i++;
      // console.log(date.setSeconds(date.getSeconds() + 5));

      // var now = new Date().getTime();
      var timeleft = countDownDate - now;
          
      // Calculating the days, hours, minutes and seconds left
      // var days = Math.floor(timeleft / (1000 * 60 * 60 * 24));
      var hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((timeleft % (1000 * 60)) / 1000);
          
      // Result is output to the specific element
      // document.getElementById("days").innerHTML = days + ""
      document.getElementById("hours").innerHTML = hours + " Jam " 
      document.getElementById("mins").innerHTML = minutes + " Menit " 
      document.getElementById("secs").innerHTML = seconds + " Detik" 
          
      // Display the message when countdown is over
      if (timeleft < 0) {
          clearInterval(myfunc);
          // document.getElementById("days").innerHTML = ""
          // document.getElementById("hours").innerHTML = "" 
          // document.getElementById("mins").innerHTML = ""
          // document.getElementById("secs").innerHTML = ""
          document.getElementById("end").innerHTML = "UJIAN SELESAI!!";

          idpaketmst = $('#btn-selesai').attr('upaketsoalmst');
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
              type: "POST",
              dataType: "JSON",
              url: "{{url('selesaiujian')}}",
              async: false,
              data: {
                idpaketmst : idpaketmst
              },
              beforeSend: function () {
                  $.LoadingOverlay("show", {
                      image       : "{{asset('/image/global/loading.gif')}}"
                  });
              },
              success: function(response)
              {
                if (response.status) {
                    $('.modal').modal('hide');
                    Swal.fire({
                        html: response.message,
                        icon: 'success',
                        showConfirmButton: true
                    }).then((result) => {
                        $.LoadingOverlay("show", {
                          image       : "{{asset('/image/global/loading.gif')}}"
                        });
                        reload_url(1500,response.menu);
                    })

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
      }, 1000);
      // END COUNDOWN
  });
</script>
<!-- Loading Overlay -->
@endsection


