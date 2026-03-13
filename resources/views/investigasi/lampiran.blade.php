@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet" href="{{ asset('js/plugins/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.3/css/rowGroup.dataTables.min.css">
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
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-bs5/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.colVis.min.js') }}"></script>

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
         $(document).ready(function () {
            listLampiran();
         });

         function listLampiran(){
            var id = $('#id_invenstigasi').val();
            console.log(id);
            $('.js-dataTable-list').dataTable({
                pageLength: 10,
                lengthMenu: [[10, 20, 30, 40], [10, 20, 30, 40]],
                autoWidth: false,
                ajax: '{{ url("getlampiranfoto") }}'+ '/' + id,
                columns: [
                    {data: 'DT_RowIndex' , name: 'id', width: '5%'},
                    {data: 'title', name: 'title'},
                    {data: 'gambar', name: 'gambar'},
                    {data: 'keterangan', name: 'keterangan'},
                    {data: 'action', name: 'action', orderable: false, searchable: true,width: '5%' },
                ],
                order: [[2, 'asc']],
                rowGroup: {
                    dataSrc: 'title'
                }
            });
        }

        $("#upload-lampiran").on("submit",function(e){
            e.preventDefault()
            var id = $('#id_invenstigasi').val();
            $('#in_id').val(id);
            $('#btnupload').html('Sending..');
            var formData = new FormData(this);

            $.ajax({
                type:'POST',
                url: '{{ url("uploadlampiran") }}',
                data: formData,
                processData: false,
                cache:false,
                contentType: false,
                beforeSend:function(){
                    $('#upload-lampiran').find('span.error-text').text();
                    },
                success: function(data){
                    if(data.code==1){
                        One.helpers('jq-notify', 
                        {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil diupload!'});
                        $('#btnupload').html('Upload');
                        $('#modal-upload').modal('hide');
                        $('#judul').val('');
                        $('#images').val('');
                        $('#keterangan').val('');
                        $('.js-dataTable-list').DataTable().ajax.reload();
                        // listLampiran();
                    }else{
                        One.helpers('jq-notify', 
                        {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil diupload!'});
                        console.log(data);
                    }
                   
                }
            })
        })

        $('body').on("click",".btn-delete",function(){
            var id = $(this).attr("id");
            var kd = $(this).attr("id");
            $(".btn-destroy").attr("id",id);
            $("#destroy-modalLabel").text("Yakin Hapus Data :" +id);
            $("#modal-delete-upload_foto").modal("show");
        });

         $(".btn-destroy").on("click",function(){
            var id = $(this).attr("id")
            $.ajax({
                url: '{{ url("dellampiranfoto") }}'+ '/' + id,
                method : 'DELETE',
                success:function(){
                    $("#modal-delete-upload_foto").modal("hide");
                    $('.js-dataTable-list').DataTable().ajax.reload();  
                    One.helpers('jq-notify', 
                    {type: 'danger', icon: 'fa fa-check me-1', message: 'Berhasil dihapus!'});
                },
                error: function(xhr, status, error){
                var errorMessage = xhr.status + ': ' + xhr.statusText
                },
            });
        })

        $('body').on("click",".btn-edit",function(){
            var id = $(this).attr("id");
            $.ajax({
                url: '{{ url("getidlampiranfoto") }}'+ '/' + id,
                method : 'GET',
                success:function(data){
                     $('#modal-upload').modal('show');
                     $('#btnupload').html('Save Edit');
                     $('#id').val(data.result.id);
                     $('#in_id').val(data.result.investigasi_id);
                     $('#judul').val(data.result.title);
                     $('#keterangan').val(data.result.keterangan);
                     $('#images').val(data.result.path);

                },
                error: function(xhr, status, error){
                var errorMessage = xhr.status + ': ' + xhr.statusText
                },
            });
        });
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
                        Lampiran Investigasi
                    </h2>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        No Case :<b>{{$data->no_case}}</b> | {{$data->nm_perusahaan}}
                    </h2>
                    <input type="hidden" id="id_invenstigasi" value="{{$data->id}}">
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{route('investigasi')}}">Investigasi</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Lampiran Investigasi
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
                <a href="javascript:history.back()" class="btn btn-alt-primary btn-sm">
                    <i class="fa fa-arrow-alt-circle-left text-info me-1"></i>Kembali
                </a>
                <button type="button" type="button" class="btn btn-alt-primary  btn-sm" data-bs-toggle="modal" data-bs-target="#modal-upload">
                    <i class="fa fa-plus text-info me-1"></i>Add Lampiran
                </button>  
            </div>
            
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-list">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th class="text-center" style="width: 15%;">Title</th>
                            <th class="text-center" style="width: 15%;">Lampiran/Foto</th>
                            <th class="text-center" class="d-none d-sm-table-cell">Keterangan</th>
                            <th style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
     
            </div>
            
        </div>
        <!-- END Dynamic Table with Export Buttons -->
    </div>
    <!-- END Page Content -->

     <!-- modal upload foto -->
     <div class="modal fade" id="modal-upload" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Upload File</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                    <form id="upload-lampiran"  method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
                        @csrf
                        <div class="row push">
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label for="" class="form-label">Judul Foto</label>
                                    <input type="hidden" id="id" name="id">
                                    <input type="hidden" id="in_id" name="investigasi_id">
                                    <input required class="form-control" type="text" name="judul" id="judul" placeholder="Title image">
                                </div>
                                <div class="form-group">
                                    <input required class="form-control" type="file" name="images" id="images" placeholder="Choose images" multiple >
                                </div>
                                <div class="form-group mb-2">
                                    <label for="" class="form-label">Keterangan</label>
                                    <textarea class="form-control" type="text" name="keterangan" id="keterangan" rows="4" placeholder="Keterangan"></textarea>
                                </div>
                            </div> 
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-alt-primary mt-2" id="btnupload">Upload</button>
                            </div>
                        </div>    
                    </div>     
                    </form>
                    </div>
                    
                </div>
            </div>
        </div>
     </div>
    <!-- end modal upload foto -->
    <!-- modal delete upload foto-->
    <div class="modal fade" id="modal-delete-upload_foto" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog modal-vcenter" role="document">
            <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                <h3 class="block-title">Hapus Data</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
                </div>
                <div class="block-content fs-sm text-center">
                    <h5>Yakin akan menghapus data?</h5>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-sm btn-danger btn-destroy">Hapus</button>
                </div>
            </div>
            </div>
        </div>
    </div>
     <!-- END modal delete upload foto-->
    
@endsection
