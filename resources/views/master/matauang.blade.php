@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('css/oneui.min.css')}}">
    @endsection
    
@section('js_after')
    <!-- jQuery (required for DataTables plugin) -->
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/oneui.app.min.js') }}"></script>
    
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-bs5/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.colVis.min.js') }}"></script>
    
    <!-- Page JS Code -->
    <script>
        $("#createForm").on("submit",function(e){
    e.preventDefault()
    var data = $(this).serialize();
    console.log(data);
    $.ajax({
        url: "matauang",
        method: "POST",
        data: $(this).serialize(),
        success:function(){
            $("#modal-add").modal("hide")
            $('.js-dataTable-buttons').DataTable().ajax.reload();
            One.helpers('jq-notify', 
            {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil disimpan!'});
            clearForm();
        }
    })
})

function clearForm(){
    $("[name='matauang']").val("")
}

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
        url: "matauang/"+id,
        method : 'DELETE',
        success:function(){
            $("#modal-delete").modal("hide")
            $('.js-dataTable-buttons').DataTable().ajax.reload();
            One.helpers('jq-notify', 
            {type: 'danger', icon: 'fa fa-check me-1', message: 'Berhasil dihapus!'});
        },
        error: function(xhr, status, error){
        var errorMessage = xhr.status + ': ' + xhr.statusText
        
        },
    });
})

//Edit & Update
$('body').on("click",".btn-edit",function(){
    var id = $(this).attr("id");
    $('#form_result').html('');
     console.log(id);
    $.ajax({
        url: "/matauang/"+id+"/edit",
        method: "GET",
        dataType : "json",
        success:function(html){
            $("#modal-edit").modal("show")
            $("#id").val(html.data.id)
            $("#editmatauang").val(html.data.matauang)
        }
    });
});

$("#editForm").on("submit",function(e){
    e.preventDefault()
    var id = $("#id").val()
    var dt = $(this).serialize();
    console.log(id);
    console.log(dt);
    $.ajax({
        url: "/matauang/"+id,
        method: "PATCH",
        data: $(this).serialize(),
        success:function(){
            $('.js-dataTable-buttons').DataTable().ajax.reload();
            $("#modal-edit").modal("hide")
            One.helpers('jq-notify', 
                {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil diupdate!'});
        }
    })
})
//Edit & Update
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
    </script>
    <script type="text/javascript">
        $('.js-dataTable-buttons').dataTable({
            pageLength: 5,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            autoWidth: false,
            buttons: [
                { extend: 'copy', className: 'btn btn-sm btn-primary',
                    exportOptions: {
                      columns: [ 0,1,2,3 ]
                      } 
                },
                { extend: 'csv', className: 'btn btn-sm btn-primary',
                    exportOptions: {
                      columns: [ 0,1,2,3 ]
                      } 
                },
                { extend: 'print', className: 'btn btn-sm btn-primary',
                    exportOptions: {
                      columns: [ 0,1,2,3 ]
                      } 
                }
            ],
            ajax: '{{ url("matauang") }}',
            columns: [
                {data: 'DT_RowIndex' , name: 'id', width: '5%'},
                {data: 'matauang', name: 'matauang'},
                {data: 'action', name: 'action', orderable: false, searchable: true,width: '5%' },
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
                    <h2 class="h3 fw-bold mb-2">
                        Mata Uang
                    </h2>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        Master Data Mata Uang
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">Master</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Mata Uang
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
                    DATA MATA UANG
                </h3>
                <button type="button" class="btn btn-alt-primary  btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add">Tambah Data</button>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons fs-sm">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">#</th>
                            <th>Mata Uang</th>
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
        </div>
        <!-- END Dynamic Table with Export Buttons -->
    </div>
    <!-- END Page Content -->

    <!-- modal-add -->
    <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Tambah data Mata Uang</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        <form id="createForm">
                        <div class="form-floating mb-4">
                            <input required="" autocomplete="off" type="text" class="form-control" id="matauang" name="matauang" placeholder="mata uang">
                            <label for="example-text-input-floating">Mata Uang</label>
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
                        <h3 class="block-title">Ubah data Mata Uang</h3>
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
                            <input required="" autocomplete="off" type="" class="form-control" id="editmatauang" name="matauang" placeholder="Jenis klaim">
                            <label for="example-text-input-floating">Mata Uang</label>
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
