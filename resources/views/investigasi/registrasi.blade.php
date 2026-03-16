@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet" href="{{ asset('js/plugins/flatpickr/flatpickr.min.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('js_after')
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/additional-methods.js')}}"></script>


    <script>One.helpersOnLoad(['js-flatpickr']);</script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/be_forms_validation.min.js')}}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script> 

        function generateNo(){
            var id = $('#asuransi_id option:selected').val();
            var kd_perusahaan = $("select option:selected").data('kd_value');
            var date = new Date();
            var tahun = date.getFullYear();
            var bulan = date.getMonth()+1;
            const nocase = kd_perusahaan+"/"+bulan+"."+tahun+"/";
            $('#no_case').val(nocase);
        }

        $("#createForm").on("submit",function(e){
            e.preventDefault();
            var data = $(this).serialize();
            console.log(data);
            
            $.ajax({
                url: "investigasi",
                method: "POST",
                data: $(this).serialize(),
                success:function(){
                    One.helpers('jq-notify', 
                     {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil disimpan!'});
                     window.location.href = "/investigasi";
                }
            })
        })

        $('#jenisclaim_id').change(function(){   
            var target = $('#jenisclaim_id option:selected').val();
            if (target=='1'){
                $('#tempat_meninggal').removeAttr('disabled');
                $('#tgl_meninggal').removeAttr('disabled');
            } else {
                $('#tempat_meninggal').attr('disabled', 'disabled');
                $('#tgl_meninggal').attr('disabled', 'disabled');
                $('#tempat_meninggal').val('');
                $('#tgl_meninggal').val('');
            }      
        });

        

        function save(){
            var data = $(this).serialize();
            console.log(data);
            // generateNo();
            // $.ajax({
            //     url: "investigasi",
            //     method: "POST",
            //     data: $(this).serialize(),
            //     success:function(){
            //         One.helpers('jq-notify', 
            //          {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil disimpan!'});
            //          window.location.href = "/investigasi";
            //     }
            // })
        };
        
        $('#asuransi_id').change(function(){   
            generateNo();
            checkReliance();
        });

        function checkReliance() {
    // Mengambil teks dari opsi asuransi yang dipilih
    var selectedText = $('#asuransi_id option:selected').text();
    
    // Jika teks mengandung kata 'RELIANCE'
    if (selectedText.includes('RELIANCE')) {
        $('#policy_information_reliance').show();
    } else {
        // Sembunyikan container utama
        $('#policy_information_reliance').hide();
        
        // Menghapus nilai (Reset) berdasarkan ID yang ada di HTML Anda
        $('#nama_peserta').val('');
        $('#nomor_peserta').val('');
        $('#tgl_mulai').val('');
        $('#tgl_pengajuan').val('');
        $('#tgl_selesai').val('');
        $('#tgl_klaim').val('');
        
    }
}


        $('#tgl_meninggal').change(function(){   
            getUsiapolis();
        });

        // function tes(){
        //     alert('tes');
        //     generateNo();
        // };

        function getUsiapolis() {
            var date = document.getElementById('tgl_meninggal').value;
            var dateefektif = document.getElementById('tgl_efektif_polis').value;
            var bulan1=date.getMonth();
            var bulan2=dateefektif.getMonth();
            console.log(dateefektif)
        
            if(date === ""){
                alert("Please complete the required field!");
            }else{
                var efektifpolis = new Date(dateefektif);
                var tgl_meninggal = new Date(date);
                var year = 0;
                if (tgl_meninggal.getMonth() < efektifpolis.getMonth()) {
                    year = 1;
                } else if ((tgl_meninggal.getMonth() == efektifpolis.getMonth()) && tgl_meninggal.getDate() < efektifpolis.getDate()) {
                    year = 1;
                }
                var usiapolis = tgl_meninggal.getFullYear() - efektifpolis.getFullYear() - year;
        
                if(usiapolis < 0){
                    usiapolis = 0;
                }
                const upolis = usiapolis+" Tahun";
                $('#usia_polis').val(upolis);
            }
        }

        $('#alamat_provinsi').change(function(){
        $("#alamat_kabupaten").empty();
        $("#alamat_kecamatan").empty();
        var provinsi_id = $(this).val();  
        console.log(provinsi_id);  
        if(provinsi_id){
            $.ajax({
            type:"GET",
            url:"{{route('getKabupaten')}}",
            data : {
                provinsi_id : provinsi_id
            },
            success:function(res){               
                if(res){
                    $("#alamat_kabupaten").empty();
                    $("#alamat_kabupaten").append('<option value="">---pilih kabupaten/kota---</option>');
                    $.each(res,function(index,kabupaten){
                        $("#alamat_kabupaten").append('<option value="'+kabupaten.id+'">'+kabupaten.kabupaten+'</option>');
                    });
                }else{
                $("#alamat_kabupaten").empty();
                }
            }
            });
            }else{
            
            }      
        });

        $('#alamat_kabupaten').change(function(){
            $("#alamat_kecamatan").empty();
        var kabupaten_id = $(this).val();  
        console.log(kabupaten_id);  
        if(kabupaten_id){
            $.ajax({
            type:"GET",
            url:"{{route('getKecamatan')}}",
            data : {
                kabupaten_id : kabupaten_id
            },
            success:function(res){               
                if(res){
                    $("#alamat_kecamatan").empty();
                    $("#alamat_kecamatan").append('<option value="">---pilih kabupaten/kota---</option>');
                    $.each(res,function(index,kecamatan){
                        $("#alamat_kecamatan").append('<option value="'+kecamatan.id+'">'+kecamatan.kecamatan+'</option>');
                    });
                }else{
                $("#alamat_kecamatan").empty();
                }
            }
            });
            }else{
            
            }      
        });

        $('#asuransi_id').on('change', function() {
    var selectedValue = $(this).val();
    var selectedText = $('#asuransi_id option:selected').text();

    // Pastikan ID selector sesuai dengan ID yang ditambahkan di label
    if (selectedValue === '37' || selectedText.includes('RELIANCE')) {
        $('#label_pemegang_polis').text('Nama Pemegang Polis / Koperasi');
    } else {
        $('#label_pemegang_polis').text('Nama Pemegang Polis');
    }
});
    </script>
    <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('js/pages/be_forms_validation.min.js')}}"></script>


@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h2 class="h3 fw-bold mb-2">
                        Registrasi Investigasi
                    </h2>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        New Case Investigasi
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{route('investigasi')}}">Investigasi</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Registrasi
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- <form action="" id="createForm" method="post" enctype="multipart/form-data" class="js-validation">
             -->
        <form action="{{ route('investigasi.store') }}"  method="post" enctype="multipart/form-data">
        @csrf
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    POLICY INFORMATION
                </h3>
            </div>
            
            <div class="block-content block-content-full">
                <div class="row">
                    <div class="col-lg-12 space-y-3">
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="nm_perusahaan">Nama Perusahaan</label>
                            <div class="col-sm-8">
                                <select class="form-select {{ $errors->has('asuransi_id') ? 'is-invalid' : ''}}"  id="asuransi_id" name="asuransi_id">
                                    <option selected=""></option>
                                    @foreach ($asuransi as $item)
                                    <option value="{{$item->id}}" data-kd_value="{{$item->kd_perusahaan}}">{{$item->kd_perusahaan}} - {{$item->nm_perusahaan}}</option>
                                    @endforeach
                                    
                                </select>
                                @if ($errors->has('asuransi_id'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('asuransi_id') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <span id="form_result"></span>
                            <label class="col-sm-4 col-form-label" for="example-hf-email">No Case<span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input readonly value="{{ old('no_case') }}" type="text" class="form-control" id="no_case" name="no_case">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Tgl Registrasi</label>
                            <div class="col-sm-8">
                                <input type="text" class="js-flatpickr form-control {{ $errors->has('tgl_registrasi') ? 'is-invalid' : ''}}" id="tgl_registrasi" name="tgl_registrasi" placeholder="Y-m-d">
                                @if ($errors->has('tgl_registrasi'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('tgl_registrasi') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">No Polis</label>
                            <div class="col-sm-8">
                                <input type="text"  class="form-control {{ $errors->has('no_polis') ? 'is-invalid' : ''}}" id="no_polis" name="no_polis">
                                @if ($errors->has('no_polis'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('no_polis') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Nama Tertanggung</label>
                            <div class="col-sm-8">
                                <input type="text"  class="form-control" id="nm_tertanggung" name="nm_tertanggung">
                            </div>
                        </div>
                        <div class="row">
<label class="col-sm-4 col-form-label" id="label_pemegang_polis" for="nm_pemegang_polis">Nama Pemegang Polis</label>                            <div class="col-sm-8">
                                <input type="text"  class="form-control" id="nm_pemegang_polis" name="nm_pemegang_polis">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Nama Agen</label>
                            <div class="col-sm-8">
                                <input type="text"  class="form-control" id="nm_agen" name="nm_agen">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="alamat_provinsi">Provinsi</label>
                            <div class="col-sm-8">
                                <select class="form-select" id="alamat_provinsi" name="alamat_provinsi">
                                    <option selected="">pilih provinsi</option>
                                    @foreach ($provinsi as $item)
                                    <option value="{{$item->id}}">{{$item->provinsi}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="alamat_kabupaten">Kabupaten/Kota</label>
                            <div class="col-sm-8">
                                <select class="form-select" id="alamat_kabupaten" name="alamat_kabupaten">
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="alamat_kecamatan">Kecamatan</label>
                            <div class="col-sm-8">
                                <select class="form-select" id="alamat_kecamatan" name="alamat_kecamatan">
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Alamat Tertanggung</label>
                            <div class="col-sm-8">
                            <textarea class="form-control"  id="alamat_tertanggung" name="alamat_tertanggung" rows="2" placeholder="alamat.."></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Tgl. SPAJ</label>
                            <div class="col-sm-8">
                                <input type="text" class="js-flatpickr form-control" id="tgl_spaj" name="tgl_spaj" placeholder="Y-m-d">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-password">Efektif Polis</label>
                            <div class="col-sm-8">
                            <input type="text" class="js-flatpickr form-control" id="tgl_efektif_polis" name="tgl_efektif_polis" placeholder="Y-m-d">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Tanggal Joint</label>
                            <div class="col-sm-8">
                                <input type="text" class="js-flatpickr form-control" id="tgl_joint" name="tgl_joint" placeholder="Y-m-d">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Usia Polis</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="usia_polis" name="usia_polis">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Pekerjaan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-matauang">Mata Uang</label>
                            <div class="col-sm-8">
                                <select class="form-select"  id="matauang" name="matauang">
                                    <option value="">--pilih mata uang--</option>
                                    @foreach ($matauang as $uang)
                                    <option value="{{$uang->matauang}}">{{$uang->matauang}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Premi</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="premi" name="premi">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Total Premi</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="total_premi" name="total_premi">
                            </div>
                        </div>
                        
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Uang pertanggungan</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="uang_pertanggungan" name="uang_pertanggungan">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- POLICY INFORMATION RELIANCE INDONESIA -->
        <div class="block block-rounded" id="policy_information_reliance" style="display:none;">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    PARTICIPANT INFORMATION (RELIANCE INDONESIA)
                </h3>
            </div>
            
            <div class="block-content block-content-full">
                <div class="row">
                    <div class="col-lg-12 space-y-3">
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="nama_peserta">Nama Peserta</label>
                            <div class="col-sm-8">
                                <input type="text" value="{{ $item->nama_peserta }}" class="form-control" id="nama_peserta" name="nama_peserta">
                            </div>
                        </div>
                         <div class="row">
                            <label class="col-sm-4 col-form-label" for="nomor_peserta">Nomor Peserta</label>
                            <div class="col-sm-8">
                                <input type="text" value="{{ $item->nomor_peserta }}" class="form-control" id="nomor_peserta" name="nomor_peserta">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="tgl_mulai">Tanggal terbit/Tgl Mulai</label>
                            <div class="col-sm-8">
                                <input type="text" value="{{ $item->tgl_mulai }}" class="js-flatpickr form-control" id="tgl_mulai" name="tgl_mulai" placeholder="Y-m-d">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="tgl_pengajuan">SPAJ/Tgl Pengajuan</label>
                            <div class="col-sm-8">
                                <input type="text" value="{{ $item->tgl_pengajuan }}" class="js-flatpickr form-control" id="tgl_pengajuan" name="tgl_pengajuan" placeholder="Y-m-d">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="tgl_selesai">Tgl Selesai</label>
                            <div class="col-sm-8">
                                <input type="text" value="{{ $item->tgl_selesai }}" class="js-flatpickr form-control" id="tgl_selesai" name="tgl_selesai" placeholder="Y-m-d">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="tgl_klaim">Tanggal Klaim</label>
                            <div class="col-sm-8">
                                <input type="text" value="{{ $item->tgl_klaim }}" class="js-flatpickr form-control" id="tgl_klaim" name="tgl_klaim" placeholder="Y-m-d">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    CLAIM INFORMATION
                </h3>
            </div>

            <div class="block-content block-content-full">
                <div class="row">
                    <div class="col-lg-12 space-y-3">
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="nm_perusahaan">Jenis Klaim</label>
                            <div class="col-sm-8">
                                <select class="form-select {{ $errors->has('jenisclaim_id') ? 'is-invalid' : ''}}" id="jenisclaim_id" name="jenisclaim_id">
                                    <option selected=""></option>
                                    @foreach ($klaim as $item)
                                    <option value="{{$item->id}}">{{$item->jenis_klaim}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('jenisclaim_id'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('jenisclaim_id') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Tempat Meninggal</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="tempat_meninggal" name="tempat_meninggal">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Tgl. Meninggal</label>
                            <div class="col-sm-8">
                                <input type="text" class="js-flatpickr form-control" id="tgl_meninggal" name="tgl_meninggal" placeholder="Y-m-d">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Diagnosa utama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="diagnosa_utama" name="diagnosa_utama">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Tgl. dirawat dr.</label>
                            <div class="col-sm-8">
                                <input type="text" class="js-flatpickr form-control" id="tgl_dirawat_dr" name="tgl_dirawat_dr" placeholder="Y-m-d">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Tgl. dirawat smp.</label>
                            <div class="col-sm-8">
                                <input type="text" class="js-flatpickr form-control" id="tgl_dirawat_smp" name="tgl_dirawat_smp" placeholder="Y-m-d">
                            </div>
                        </div>
                        
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Rumah Sakit</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="rumah_sakit" name="rumah_sakit" placeholder="">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Jumlah Klaim</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="jml_klaim" name="jml_klaim">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-password">Area Investigasi</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="area_investigasi" name="area_investigasi" placeholder="">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="provinsi">Provinsi</label>
                            <div class="col-sm-8">
                                <select class="form-select" id="provinsi" name="provinsi">
                                    <option selected="">pilih provinsi</option>
                                    @foreach ($provinsi as $item)
                                    <option value="{{$item->provinsi}}">{{$item->provinsi}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-password">Investigasi Fee</label>
                            <div class="col-sm-8">
                            <input type="hidden" id="status" name="status" value="0">
                            <input type="number" class="form-control" id="investigasi_fee" name="investigasi_fee" placeholder="">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="provinsi">Investigator</label>
                            <div class="col-sm-8">
                                <select class="form-select {{ $errors->has('investigator_id') ? 'is-invalid' : ''}}" id="investigator_id" name="investigator_id">
                                    <option selected=""></option>
                                    @foreach ($investigator as $item)
                                    <option value="{{$item->id}}">{{$item->nm_investigator}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('investigator_id'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('investigator_id') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="tgl_kirim_dokumen">Tanggal Kirim Dokumen</label>
                            <div class="col-sm-8">
                                <input type="text" class="js-flatpickr form-control" id="tgl_kirim_dokumen" name="tgl_kirim_dokumen" placeholder="Y-m-d">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Informasi Tambahan Waktu</label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control" rows="2" id="tambahan_waktu" name="tambahan_waktu"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-password">Pengaju Klaim</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="pengaju_klaim" name="pengaju_klaim" placeholder="">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Kronologi Singkat</label>
                            <div class="col-sm-8">
                            <textarea class="form-control"  id="kronologi_singkat" name="kronologi_singkat" rows="3" placeholder="kronologi singkat.."></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Metode Investigasi</label>
                            <div class="col-sm-8">
                            <textarea class="form-control"  id="metode_investigasi" name="metode_investigasi" rows="3" placeholder="metode investigasi.."></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Plan</label>
                            <div class="col-sm-8">
                                <textarea class="form-control"  id="plan" name="plan" rows="3" placeholder="plan.."></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="agen_terlibat">Keterlibatan Agen</label>
                            <div class="col-sm-8">
                                <select class="form-select" id="agen_terlibat" name="agen_terlibat">
                                    <option selected=""></option>
                                    <option value="Tidak terlibat">Tidak terlibat</option>
                                    <option value="Terlibat">Terlibat</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <hr>
                <div class="row g-3">
                    <div class="col-lg-12 space-y-3">
                        <label class="col-sm-4 col-form-label" for="example-hf-email">Tambahan Informasi Lain</label>
                        <textarea type="text" class="form-control" rows="6" id="informasi_lain" name="informasi_lain"></textarea>
                    </div>
                    <input hidden value="{{$user_id}}" id="user_id" name="user_id" type="text">
                    <input hidden value="{{$user_name}}" id="user_name" name="user_name" type="text">
                </div>
                <div class="row items-push">
                    <div class="col-lg-7 offset-lg-4">
                        <a href="{{ route('investigasi') }}" class="btn btn-alt-warning mt-4"><i class="fa fa-times text-info me-1"></i>Batal</a>
                        <button type="submit" class="btn btn-alt-primary mt-4"><i class="fa fa-save text-info me-1"></i>Simpan Data</button>
                        <!--<button onclick="save()" type="button" class="btn btn-alt-primary mt-4 btn-cek"><i class="fa fa-save text-info me-1"></i>Cek</button>-->
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    </div>
    <!-- END Page Content -->

    
@endsection
