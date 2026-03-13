@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/dataTables.bootstrap5.min.css') }}">
     <link rel="stylesheet" id="css-main" href="{{  ('/css/oneui.css') }}">
@endsection


@section('js_after')
    <!-- jQuery (required for DataTables plugin) -->
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/oneui.app.js') }}"></script>
    
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-bs5/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/additional-methods.js')}}"></script>


  

    <!-- Page JS Code -->
    <script src="{{ asset ('js/oneui.app.min-5.1.js') }}"></script>
    <script src="{{ asset('js/pages/be_forms_validation.min.js')}}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script type="text/javascript">
        var id = $("#investigasi_id").val()
        $('.js-dataTable').dataTable({
            pageLength: 5,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            autoWidth: false,
            ajax: '{{ url("pendalaman") }}'+ '/' + id,
            columns: [
                {data: 'DT_RowIndex' , name: 'id', width: '2%'},
                {data: 'pendalaman', name: 'pendalaman'},
                {data: 'action', name: 'action', orderable: false, searchable: true,width: '2%' },
            ],
            dom: "<'row'<'col-sm-12'<'text-center bg-body-light py-2 mb-2'B>>>" +
                "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
        });

          
        $("#createForm").on("submit",function(e){
            e.preventDefault()
            var id = $("#investigasi_id").val()
            var data = $(this).serialize();
            console.log(data);
            $.ajax({
                url: "{{ route('pendalaman.store') }}",
                method: "POST",
                data: $(this).serialize(),
                success:function(){
                    $("#modal-pendalaman").modal("hide")
                    $('.js-dataTable').DataTable().ajax.reload();
                    One.helpers('jq-notify', 
                     {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil disimpan!'});
                }
            })
        })


        //DELETE
        $('body').on("click",".btn-delete",function(){
            var id = $(this).attr("id");
            var kd = $(this).attr("id");
            $(".btn-destroy").attr("id",id);
            $("#destroy-modalLabel").text("Yakin Hapus Data :" +id);
            $("#modal-delete").modal("show");
        });

        $(".btn-destroy").on("click",function(){
            var id = $(this).attr("id")
            console.log(id);
            $.ajax({
                url: '{{ url("pendalaman") }}'+ '/' + id,
                method : 'DELETE',
                success:function(){
                    $("#modal-delete").modal("hide")
                    $('.js-dataTable').DataTable().ajax.reload();
                    One.helpers('jq-notify', 
                    {type: 'danger', icon: 'fa fa-check me-1', message: 'Berhasil dihapus!'});
                },
                error: function(xhr, status, error){
                var errorMessage = xhr.status + ': ' + xhr.statusText
                alert('Jenis klaim tidak bisa dihapus! Sudah digunakan di investigasi');
                },
            });
        })
        //END DELETE
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
                        Pendalaman Investigasi
                    </h2>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        No Case :<b>{{$data->no_case}}</b> | {{$data->nm_perusahaan}}
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{route('investigasi')}}">Investigasi</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Pendalaman Investigasi
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
                <button type="button" type="button" class="btn btn-alt-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-pendalaman">
                    <i class="fa fa-plus text-info me-1"></i>Add Pendalaman
                </button>  
            </div>
            
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter js-dataTable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5px;">#</th>
                            <th class="text-center">Pendalaman</th>
                            <th class="text-center" style="width: 5%;">Action</th>
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

     <!-- modal ADD -->
     <div class="modal fade" id="modal-pendalaman" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Pendalaman</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                    <form id="createForm">
                        @csrf
                        <div class="row push">
                            <div class="col-md-12">
                                <input type="text" id="investigasi_id" name="investigasi_id" value="{{$data->id}}" hidden>
                                <div class="form-group mb-2">
                                    <label for="" class="form-label">Pendalaman</label>
                                    <textarea class="form-control" type="text" name="pendalaman" id="pendalaman" rows="5" placeholder="pendalaman"></textarea>
                                </div>
                        </div>
                        <!-- <div class="col-md-12">
                            <div class="mt-1 text-center">
                                <div class="show-multiple-image-preview"> </div>
                            </div>  
                        </div> -->
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-alt-primary mt-2" id="btnsimpan">Simpan</button>
                        </div>
                    </div>     
                    </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- end ADD -->

     <!-- modal delete -->
     <div class="modal" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-block-small" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
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
                <div class="block-content fs-sm">
                    <h5>Yakin akan menghapus data?</h5>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-danger btn-destroy">Delete</button>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- END Small Block Modal -->



    
@endsection
