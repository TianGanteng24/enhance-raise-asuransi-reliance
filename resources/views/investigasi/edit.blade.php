@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet" href="{{ asset('js/plugins/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" id="css-main" href="{{  ('/css/oneui.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('js_after')
    <!-- jQuery (required for DataTables plugin) -->
    <script src="{{('js/oneui.app.js') }}"></script>
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/oneui.app.js') }}"></script>
    
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
    <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('js/pages/be_forms_validation.min.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>       

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


        $("#editForm").on("submit",function(e){
            e.preventDefault()
            var id = $("#id").val()
            console.log(id);
            $.ajax({
                url: "/investigasi/"+id,
                method: "PATCH",
                data: $(this).serialize(),
                success:function(){
                    One.helpers('jq-notify', 
                        {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil diupdate!'});
                    // window.location.href = "{{route('investigasi')}}";
                    window.location.href = "/investigasi/"+id+"/detail"
                      
                }
            })
        })

        $('#alamat_provinsi').change(function(){
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
    </script>
    <!-- <script src="{{ asset('js/pages/tables_datatables.js') }}"></script> -->



@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h2 class="h3 fw-bold mb-2">
                        Update Info Registrasi Investigasi
                    </h2>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        Update Reg Investigasi
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{route('investigasi')}}">Investigasi</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Update Registrasi
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table with Export Buttons -->
        <form action="" id="editForm" method="post" enctype="multipart/form-data" class="js-validation">
        @csrf
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    UPDTE POLICY INFORMATION
                </h3>
            </div>
            <div class="block-content block-content-full">
                <div class="row">
                    <div class="col-lg-12 space-y-3">
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="nm_perusahaan">Nama Perusahaan</label>
                            <div class="col-sm-8">
                                <select disabled class="form-select"  id="asuransi_id" name="asuransi_id">
                                    <option selected="{{$detail->asuransi_id}}">{{$detail->kd_perusahaan}} - {{$detail->nm_perusahaan}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">No Case<span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input hidden readonly value="{{$detail->id}}" type="text" class="form-control" id="id" name="id">  
                                <input readonly value="{{$detail->no_case}}{{$detail->number_case}}" type="text" class="form-control" id="no_case1" name="no_case1">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Tgl Registrasi</label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$detail->tgl_registrasi}}" class="js-flatpickr form-control" id="tgl_registrasi" name="tgl_registrasi" placeholder="Y-m-d">
                            </div>
                        </div>
                        
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">No Polis</label>
                            <div class="col-sm-8">
                                <input type="text"  value="{{$detail->no_polis}}" class="form-control" id="no_polis" name="no_polis">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Nama Tertanggung</label>
                            <div class="col-sm-8">
                                <input type="text"  value="{{$detail->nm_tertanggung}}" class="form-control" id="nm_tertanggung" name="nm_tertanggung">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Nama Pemegang Polis</label>
                            <div class="col-sm-8">
                                <input type="text"  value="{{$detail->nm_pemegang_polis}}" class="form-control" id="nm_pemegang_polis" name="nm_pemegang_polis">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Nama Agen</label>
                            <div class="col-sm-8">
                                <input type="text"  value="{{$detail->nm_agen}}" class="form-control" id="nm_agen" name="nm_agen">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="alamat_provinsi">Provinsi</label>
                            <div class="col-sm-8">
                                <select class="form-select" id="alamat_provinsi" name="alamat_provinsi">
                                    <option selected="{{$detail->alamat_provinsi}}">{{$detail->provinsi}}</option>
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
                                    <option selected="{{$detail->alamat_kabupaten}}">{{$detail->kabupaten}}</option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="alamat_kecamatan">Kecamatan</label>
                            <div class="col-sm-8">
                                <select class="form-select" id="alamat_kecamatan" name="alamat_kecamatan">
                                    <option selected="{{$detail->alamat_kecamatan}}">{{$detail->kecamatan}}</option>
                                
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Alamat Tertanggung</label>
                            <div class="col-sm-8">
                            <textarea class="form-control"  id="alamat_tertanggung" name="alamat_tertanggung" rows="2" placeholder="alamat..">
                                {{$detail->alamat_tertanggung}}
                            </textarea>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Tgl. SPAJ</label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$detail->tgl_spaj}}" class="js-flatpickr form-control" id="tgl_spaj" name="tgl_spaj" placeholder="Y-m-d">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-password">Efektif Polis</label>
                            <div class="col-sm-8">
                            <input type="text" value="{{$detail->tgl_efektif_polis}}" class="js-flatpickr form-control" id="tgl_efektif_polis" name="tgl_efektif_polis" placeholder="Y-m-d">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Usia Polis</label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$detail->usia_polis}}" class="form-control" id="usia_polis" name="usia_polis">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Pekerjaan</label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$detail->pekerjaan}}" class="form-control" id="pekerjaan" name="pekerjaan">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-matauang">Mata Uang</label>
                            <div class="col-sm-8">
                                <select class="form-select"  id="matauang" name="matauang">
                                    <option value="{{$detail->matauang}}">{{$detail->matauang}}</option>
                                    @foreach ($matauang as $uang)
                                        <option value="{{$uang->matauang}}">{{$uang->matauang}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Premi</label>
                            <div class="col-sm-8">
                                <input type="number" value="{{$detail->premi}}" class="form-control" id="premi" name="premi">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Total Premi</label>
                            <div class="col-sm-8">
                                <input type="number" value="{{$detail->total_premi}}" class="form-control" id="total_premi" name="total_premi">
                            </div>
                        </div>
                       
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Uang pertanggungan</label>
                            <div class="col-sm-8">
                                <input type="number" value="{{$detail->uang_pertanggungan}}" class="form-control" id="uang_pertanggungan" name="uang_pertanggungan">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    UPDATE POLICY INFORMATION
                </h3>
            </div>
            <div class="block-content block-content-full">
                <div class="row">
                    <div class="col-lg-12 space-y-3">
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="nm_perusahaan">Jenis Klaim</label>
                            <div class="col-sm-8">
                                <select class="form-select" id="jenisclaim_id" name="jenisclaim_id">
                                    <option value="{{$detail->jenisclaim_id}}" selected="">{{$detail->jenis_klaim}}</option>
                                    @foreach ($klaim as $item)
                                    <option value="{{$item->id}}">{{$item->jenis_klaim}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Tempat Meninggal</label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$detail->tempat_meninggal}}" class="form-control" id="tempat_meninggal" name="tempat_meninggal">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Tgl. Meninggal</label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$detail->tgl_meninggal}}" class="js-flatpickr form-control" id="tgl_meninggal" name="tgl_meninggal" placeholder="Y-m-d">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Diagnosa utama</label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$detail->diagnosa_utama}}" class="form-control" id="diagnosa_utama" name="diagnosa_utama">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Tgl. dirawat dr.</label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$detail->tgl_dirawat_dr}}" class="js-flatpickr form-control" id="tgl_dirawat_dr" name="tgl_dirawat_dr" placeholder="Y-m-d">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Tgl. dirawat smp.</label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$detail->tgl_dirawat_smp}}" class="js-flatpickr form-control" id="tgl_dirawat_smp" name="tgl_dirawat_smp" placeholder="Y-m-d">
                            </div>
                        </div>
                        
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Rumah Sakit</label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$detail->rumah_sakit}}" class="form-control" id="rumah_sakit" name="rumah_sakit" placeholder="">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Jumlah Klaim</label>
                            <div class="col-sm-8">
                                <input type="number" value="{{$detail->jml_klaim}}" class="form-control" id="jml_klaim" name="jml_klaim">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-password">Area Investigasi</label>
                            <div class="col-sm-8">
                            <input type="text" value="{{$detail->area_investigasi}}" class="form-control" id="area_investigasi" name="area_investigasi" placeholder="">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="provinsi">Provinsi</label>
                            <div class="col-sm-8">
                                <select class="form-select" id="provinsi" name="provinsi">
                                    <option value="{{$detail->provinsi}}" selected="">{{$detail->provinsi}}</option>
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
                            <input type="number" value="{{$detail->investigasi_fee}}" class="form-control" id="investigasi_fee" name="investigasi_fee" placeholder="">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="provinsi">Investigator</label>
                            <div class="col-sm-8">
                                <select class="form-select" id="investigator_id" name="investigator_id">
                                    <option value="{{$detail->investigator_id}}" selected="">{{$detail->nm_investigator}}</option>
                                    @foreach ($investigator as $item)
                                    <option value="{{$item->id}}">{{$item->nm_investigator}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="tgl_kirim_dokumen">Tanggal Kirim Dokumen</label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$detail->tgl_kirim_dokumen}}" class="js-flatpickr form-control" id="tgl_kirim_dokumen" name="tgl_kirim_dokumen" placeholder="Y-m-d">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Tambahan Waktu</label>
                            <div class="col-sm-8">
                                <textarea type="text" value="{{$detail->tambahan_waktu}}" class="form-control" rows="3" id="tambahan_waktu" name="tambahan_waktu">{{$detail->tambahan_waktu}}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-password">Pengaju Klaim</label>
                            <div class="col-sm-8">
                            <input type="text" value="{{$detail->pengaju_klaim}}" class="form-control" id="pengaju_klaim" name="pengaju_klaim" placeholder="">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Kronologi Singkat</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" value="{{$detail->kronologi_singkat}}"  id="kronologi_singkat" name="kronologi_singkat" rows="3" placeholder="kronologi singkat.."></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Metode Investigasi</label>
                            <div class="col-sm-8">
                                <textarea class="form-control"  value="" id="metode_investigasi" name="metode_investigasi" rows="3" placeholder="metode investigasi..">{{$detail->metode_investigasi}}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Plan</label>
                            <div class="col-sm-8">
                                <textarea class="form-control"  id="plan" name="plan" rows="3" placeholder="plan..">{{$detail->plan}}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="agen_terlibat">Keterlibatan Agen</label>
                            <div class="col-sm-8">
                                <select class="form-select" id="agen_terlibat" name="agen_terlibat">
                                    <option value="{{$detail->agen_terlibat}}" selected="">{{$detail->agen_terlibat}}</option>
                                    <option value="Tidak terlibat">Tidak terlibat</option>
                                    <option value="Terlibat">Terlibat</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-lg-12 space-y-3">
                        <label class="col-sm-4 col-form-label" for="example-hf-email">Tambahan Informasi Lain</label>
                        <textarea type="text" class="form-control" rows="6" id="informasi_lain" name="informasi_lain">{{$detail->informasi_lain}}</textarea>
                    </div>
                </div>
                <div class="row items-push">
                    <div class="col-lg-7 offset-lg-4">
                        <button type="submit" class="btn btn-alt-primary mt-4"><i class="fa fa-save text-info me-1"></i>Update Data</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- END Page Content -->

    
@endsection
