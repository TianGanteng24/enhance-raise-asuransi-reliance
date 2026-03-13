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
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/oneui.app.js') }}"></script>
    
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/additional-methods.js')}}"></script>

    <script src="{{ asset('js/plugins/ckeditor/ckeditor.js')}}"></script>
    <script src="{{ asset('js/plugins/simplemde/simplemde.min.js')}}"></script>
    <script>One.helpersOnLoad(['js-ckeditor', 'js-simplemde']);</script>
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
        $(function() {
            CKEDITOR.config.extraPlugins = 'justify';
        });

        $("#createForm").on("submit",function(e){
            e.preventDefault()
            var id = $("#investigasi_id").val()
            for ( instance in CKEDITOR.instances )
                CKEDITOR.instances[instance].updateElement();
            var data = $(this).serialize();
            console.log(data);
            // alert('tes');
            // const alert = One.helpers('jq-notify', 
            //         {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil disimpan!'});
            $.ajax({
                url: "{{ route('updateinvestigasi.store') }}",
                method: "POST",
                data: $(this).serialize(),
                success:function(){
                    One.helpers('jq-notify', 
                     {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil disimpan!'});
                     window.location.href = "/investigasi/"+id+"/detail"
                }
            })
        })
    </script>

    <!-- <script src="{{ asset('js/pages/tables_datatables.js') }}"></script> -->
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
                        Update Investigasi
                    </h2>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        No Case : <b>{{$data->no_case}} | {{$data->nm_perusahaan}}</b>
                    </h2>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        Tgl Registrasi : {{$data->tgl_registrasi}}
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{route('investigasi')}}">Investigasi</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Update Investigasi
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
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    UPDATE INVESTIGASI
                </h3>
                <a href="javascript:history.back()" class="btn btn-alt-primary btn-sm">
                    <i class="fa fa-arrow-alt-circle-left text-info me-1"></i>Kembali
                </a>
            </div>
            
            <div class="block-content block-content-full">
                <form action="" id="createForm" method="POST" class="js-validation" onsubmit="return false;">
                    <div class="row">
                        <div class="col-lg-4">
                            <p class="fs-sm text-muted">
                            Tanggal Update Investigasi
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <div class="mb-4">
                                <input type="text" hidden value="{{$data->id}}" class="form-control" id="investigasi_id" name="investigasi_id" placeholder="">
                                <input type="text" class="js-flatpickr form-control" id="tanggal" name="tanggal" placeholder="Y-m-d">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <p class="fs-sm text-muted">
                            Tampilkan Tanggal dilaporan
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <div class="mb-4">
                            <select class="form-select" id="tampilkan_tgl" name="tampilkan_tgl">
                                <option value="1">Tampilkan</option>
                                <option value="0">Tidak ditampilkan</option>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <p class="fs-sm text-muted">
                            Kategori Investigasi
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-6">
                            <div class="mb-4">
                            <select class="form-select" id="kategoriinvestigasi_id" name="kategoriinvestigasi_id">
                                <option selected="">pilih kategori</option>
                                @foreach ($kategori as $item)
                                <option value="{{$item->id}}">{{$item->kategori_investigasi}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label fs-sm text-muted" for="example-hf-email">Deskripsi Investigasi</label>
                        <textarea type="text" class="form-control" rows="20" id="js-ckeditor" name="update_investigasi"></textarea>
                    </div>

                    <div class="row items-push">
                        <input hidden type="text" value="{{$user_id}}" id="user_id">
                        <div class="col-lg-7 offset-lg-4">
                            <a href="{{ url()->previous() }}" class="btn btn-alt-warning mt-3"><i class="fa fa-times text-info me-1"></i>Batal</a>
                            <button type="submit" class="btn btn-alt-primary mt-3"><i class="fa fa-save text-info me-1"></i>Simpan Data</button>
                        </div>
                    </div>
                </form>
            </div>     
            </div>
            
        </div>
        <!-- END Dynamic Table with Export Buttons -->
    </div>
    <!-- END Page Content -->

    
@endsection
