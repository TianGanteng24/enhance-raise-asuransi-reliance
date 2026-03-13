@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Dashboard
                    </h1>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        Welcome <span class="fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success fs-sm">{{$user->name}}</span>, everything looks great.
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">App</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Dashboard
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="row row-deck">
            <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                <dl class="mb-0">
                    <dt class="fs-3 fw-bold">{{$onGoing}}</dt>
                    <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Ongoing Investigation</dd>
                </dl>
                <div class="item item-rounded-lg bg-body-light">
                    <i class="far fa-arrow-alt-circle-right fs-3 text-primary"></i>
                </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{route('getOnGoing')}}">
                    <span>View Ongoing Investigation</span>
                    <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                </a>
                </div>
            </div>
            </div>
            <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                <dl class="mb-0">
                    <dt class="fs-3 fw-bold">{{$complete}}</dt>
                    <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Complete Investigation</dd>
                </dl>
                <div class="item item-rounded-lg bg-body-light">
                    <i class="far fa-check-circle fs-3 text-primary"></i>
                </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{route('complete')}}">
                    <span>View Complete investigation</span>
                    <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                </a>
                </div>
            </div>
            </div>
            <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                <dl class="mb-0">
                    <dt class="fs-3 fw-bold">{{$wait}}</dt>
                    <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Waiting For Approve</dd>
                </dl>
                <div class="item item-rounded-lg bg-body-light">
                    <i class="far fa-clock fs-3 text-primary"></i>
                </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{route('waitApprove')}}">
                    <span>View all</span>
                    <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                </a>
                </div>
            </div>
            </div>
            <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                <dl class="mb-0">
                    <dt class="fs-3 fw-bold">{{$client}}</dt>
                    <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Total Client</dd>
                </dl>
                <div class="item item-rounded-lg bg-body-light">
                    <i class="far fa-user-circle fs-3 text-primary"></i>
                </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" data-bs-toggle="modal" data-bs-target="#modal-client" href="javascript:void(0)">
                    <span>View all</span>
                    <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                </a>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
    
    <!--MODAL View Client -->
    <div class="modal fade" id="modal-client" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">List Client</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-lg" style="align-text:center">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons fs-sm">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 80px;">#</th>
                                        <th>Nama Perusahaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i=1)
                                    @foreach ($clientview as $item)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$item->nm_perusahaan}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Batal</button> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
