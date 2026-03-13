@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('css/oneui.min.css')}}">
    <link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet" href="{{ asset('js/plugins/flatpickr/flatpickr.min.css')}}">
    @endsection
    
@section('js_after')
    <!-- jQuery (required for DataTables plugin) -->
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/oneui.app.min.js') }}"></script>
    
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-bs5/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.colVis.min.js') }}"></script>
    <script>One.helpersOnLoad(['js-flatpickr']);</script>
    
    <!-- Page JS Code -->

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
    </script>
    <script type="text/javascript">
        function listAll(tgl1='',tgl2='',asuransi=''){
            $('.js-dataTable-buttons').dataTable({
                pageLength: 5,
                lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
                autoWidth: false,
                buttons: [
                    { extend: 'csv', className: 'btn btn-sm btn-primary',
                        exportOptions: {
                            columns: [ 0,1,2,3 ]
                            } 
                    }
                ],
                ajax: {
                    url :"{{ url('management') }}",
                    data : {dr_tgl : tgl1,
                        smp_tgl : tgl2,
                        asuransi : asuransi},
                    },
                columns: [
                    {data: 'DT_RowIndex', name: 'id',className: "text-center",width: '4%'},
                    {data: 'tot_kasus' , name: 'tot_kasus',className: "text-center", width: '5%'},
                    {data: 'tot_temuan', name: 'tot_temuan',className: "text-center", width: '10%'},
                    {data: 'tidak_ada_temuan', name: 'tidak_ada_temuan',className: "text-center", width: '25%'},
                    {data: 'agen', name: 'agen',className: "text-center"},
                    {data: 'insurance_shop', name: 'insurance_shop',className: "text-center", width: '15%'},
                    {data: 'uang_per', name: 'uang_per',className: "text-end", width: '15%',
                        render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    {data: 'uang_selamat', name: 'uang_selamat',className: "text-end", width: '15%',
                        render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    
                ],
                
                destroy: true,
                dom: "<'row'<'col-sm-12'<'text-center bg-body-light py-2 mb-2'B>>>" +
                    "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
            });
        }

        $('#btn-filter').click(function(){

            var tgl1 = $('#tgl_dr').val();
            var tgl2 = $('#tgl_smp').val();
            var asuransi = $('#asuransi_id').val();


            if(tgl1 =="" || tgl2=="" || asuransi==""){
            One.helpers('jq-notify', 
                    {type: 'warning', icon: 'fa fa-exclamation-triangle me-1', message: 'Silahkan Pilih Filter Terlebih Dahulu!'});
            }else{
                listAll(tgl1,tgl2,asuransi);
            }

            $('#btn-print').click(function(){

                var tgl1 = $('#tgl_dr').val();
                var tgl2 = $('#tgl_smp').val();
                var asuransi = $('#asuransi_id').val();

                if(tgl1 =="" ||  tgl2=="" || asuransi==""){
                One.helpers('jq-notify', 
                        {type: 'warning', icon: 'fa fa-exclamation-triangle me-1', message: 'Silahkan Pilih Filter Terlebih Dahulu!'});
                }else{
                    window.open('{{ url("/printmanagement") }}'+ '/' +tgl1+'/'+tgl2+'/'+asuransi,'_blank');
                }
                    
            });
                
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
                    Report : Management
                    </h2>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">Report</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Management
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
                    Management
                </h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->

                <div class="row-push mb-4">
                    <div class="col-lg-12">
                        <div class="row">
                            <label class="col-sm-1 col-form-label" for="nm_perusahaan">Client</label>
                            <div class="col-sm-6">
                                <select class="form-select" id="asuransi_id" name="asuransi_id">
                                    <option selected="">Client</option>
                                    @foreach ($asuransi as $item)
                                    <option value="{{$item->id}}">{{$item->nm_perusahaan}}</option>  
                                    @endforeach                                
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row-push mb-4">
                    <div class="col-lg-12">
                        <div class="row">
                            <label class="col-sm-1 col-form-label" for="nm_perusahaan">Periode</label>
                            <div class="col-sm-3">
                                <input type="text" class="js-flatpickr form-control" id="tgl_dr" name="tgl_dr" placeholder="dari">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="js-flatpickr form-control" id="tgl_smp" name="tgl_smp" placeholder="sampai">
                            </div>
                            <div class="col-sm-2">
                                <button type="button" id="btn-filter" class="btn btn-alt-primary btn-filter"><i class="fa fa-filter text-info me-1"></i>Filter</button>
                            </div>
                            <div class="col-sm-3 text-end">
                                <button type="button" id="btn-print" class="btn btn-alt-primary"><i class="fa fa-print text-info me-1"></i>Print</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons fs-sm">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">#</th>
                            <th>Total Kasus</th>
                            <th>Total Temuan Kasus</th>
                            <th>Total Tidak Ada Temuan Kasus</th>
                            <th>Total Keterlibatan agen</th>
                            <th>Indikasi Insurance Shoping</th>
                            <th>Uang Pertanggungan</th>
                            <th>Uang Pertanggungan Diselamatkan</th>
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




    
@endsection
