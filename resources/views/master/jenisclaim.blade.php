@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/buttons.bootstrap5.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @endsection
    

@section('js_after')
    <!-- jQuery (required for DataTables plugin) -->
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-bs5/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
    </script>
    <!-- Page JS Code -->
    <script src="{{ asset('js/master/jenisclaim.js') }}"></script>

    <script>
        $('.js-dataTable-buttons').dataTable({
            pageLength: 5,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            autoWidth: false,
            buttons: [
                { extend: 'copy', className: 'btn btn-sm btn-primary',
                    exportOptions: {
                      columns: [ 0,1,2 ]
                      } 
                },
                { extend: 'csv', className: 'btn btn-sm btn-primary',
                    exportOptions: {
                      columns: [ 0,1,2 ]
                      } 
                },
                { extend: 'print', className: 'btn btn-sm btn-primary',
                    exportOptions: {
                      columns: [ 0,1,2 ]
                      } 
                }
            ],
            ajax: '{{ url("jenisclaim") }}',
            columns: [
                {data: 'DT_RowIndex' , name: 'id', width: '5%'},
                {data: 'jenis_klaim', name: 'jenis_klaim'},
                {data: 'keterangan', name: 'keterangan'},
                {data: 'action', name: 'action', orderable: false, searchable: true, width: '5%' },
            ],
            dom: "<'row'<'col-sm-12'<'text-center bg-body-light py-2 mb-2'B>>>" +
                "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
        });
    </script>

@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Jenis Klaim
                    </h1>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        Master data Jenis Klaim
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">Master</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Jenis Klaim
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="notify"></div>
        <!-- Dynamic Table with Export Buttons -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    List Data Jenis Klaim <small></small>
                </h3>
                <button type="button" class="btn btn-alt-primary  btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add">Tambah Data</button>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                <table  class="table table-bordered table-striped table-vcenter js-dataTable-buttons fs-sm">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">#</th>
                            <th>Jenis Klaim</th>
                            <th class="d-none d-sm-table-cell" style="width: 30%;">Keterangan</th>
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

    <!-- modal-add -->
    <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Tambah data jenis klaim</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        <form id="createForm">
                        <div class="form-floating mb-4">
                            <input required="" autocomplete="off" type="text" class="form-control" id="jenis_klaim" name="jenis_klaim" placeholder="Jenis klaim">
                            <label for="example-text-input-floating">Jenis Klaim</label>
                        </div>
                        <div class="form-floating mb-4">
                            <textarea autocomplete="off" class="form-control" id="keterangan" name="keterangan" style="height: 100px" placeholder="Leave a comment here"></textarea>
                            <label for="example-textarea-floating">Keterangan</label>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-primary btn-store">Simpan</button>
                        </form>
                    </div>
                       
                </div>
            </div>
        </div>
    </div>
    <!-- END modal add -->

     <!-- modal-edit -->
     <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Ubah data jenis klaim</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        <span id="form_result"></span>
                        <form id="editForm">
                        <div class="form-floating mb-4">
                            <input type="hidden" required="" id="id" name="id" class="form-control">
                            <input required="" autocomplete="off" type="" class="form-control" id="editjenis_klaim" name="jenis_klaim" placeholder="Jenis klaim">
                            <label for="example-text-input-floating">Jenis Klaim</label>
                        </div>
                        <div class="form-floating mb-4">
                            <textarea autocomplete="off" class="form-control" id="editketerangan" name="keterangan" style="height: 100px" placeholder="Leave a comment here"></textarea>
                            <label for="example-textarea-floating">Keterangan</label>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-primary btn-update">Simpan</button>
                        </form>
                    </div>
                       
                </div>
            </div>
        </div>
    </div>
    <!-- END modal edit -->

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
