@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/buttons.bootstrap5.min.css') }}">
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

    <!-- Page JS Code -->
    <!-- <script src="{{ asset('js/pages/tables_datatables.js') }}"></script> -->

    <script type="text/javascript">
        $('.js-dataTable-buttons').dataTable({
            pageLength: 5,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            autoWidth: false,
            buttons: [
                { extend: 'copy', className: 'btn btn-sm btn-primary' },
                { extend: 'csv', className: 'btn btn-sm btn-primary' },
                { extend: 'print', className: 'btn btn-sm btn-primary' }
            ],
            ajax: '{{ url("investigasi") }}',
            columns: [
                {data: 'id' , name: 'id', width: '5%'},
                {data: 'no_case', name: 'no_case', width: '25%'},
                {data: 'no_polis', name: 'no_polis'},
                {data: 'nm_perusahaan', name: 'nm_perusahaan', width: '15%'},
                {data: 'nm_tertanggung', name: 'nm_tertanggung'},
                {data: 'nm_investigator', name: 'nm_investigator'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: true },
            ],
            dom: "<'row'<'col-sm-12'<'text-center bg-body-light py-2 mb-2'B>>>" +
                "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
        });

        //showdetail
        $('body').on("click",".btn-detail",function(){
            var id = $(this).attr("id");
            window.location.href = "/investigasi/"+id+"/detail";
        
            // $.ajax({
            //     url: "/investigasi/"+id+"/detail",
            //     method: "GET",
            //     success:function(response){
            //         // $("#edit-modal").modal("show")
            //         // $("#id").val(response.id)
            //         // $("#editkode").val(response.kd_rekening)
            //         // $("#editnama").val(response.nm_rekening)
            //         // $("#editjenis").val(response.jenis_rekening)
            //         // alert(id);
            //         window.location.href = "/investigasi/"+id+"/detail";
            //     }
            // })
        });
        //end show detail
    </script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h2 class="h3 fw-bold mb-2">
                        Investigasi
                    </h2>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        Data List Investigasi
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">Investigasi</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            List
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
                    LIST DATA INVESTIGASI
                </h3>
                <button type="button" class="btn btn-alt-primary  btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add">Tambah Data</button>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons fs-sm">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 90px;">#</th>
                            <th style="width: 90px;">No Case</th>
                            <th>No Polis</th>
                            <th class="d-none d-sm-table-cell" style="width: 30%;">Perusahaan</th>
                            <th>Nama Tertanggung</th>
                            <th>Investigator</th>
                            <th>Status</th>
                            <th style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table with Export Buttons -->
    </div>
    <!-- END Page Content -->

    
@endsection
