@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" id="css-main" href="{{ asset('css/oneui.min.css')}}">
    @endsection
    
@section('js_after')
    <!-- jQuery (required for DataTables plugin) -->
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/oneui.app.min.js') }}"></script>
    
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <!-- Page JS Code -->

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
    </script>
    <script>
      $("#updateForm").on("submit",function(e){
            e.preventDefault()
            var id = $("#id").val()
            var dt = $(this).serialize();
            $.ajax({
                url: "/user/"+id,
                method: "PATCH",
                data: $(this).serialize(),
                success:function(){
                    $("#modal-edit").modal("hide")
                    One.helpers('jq-notify', 
                        {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil diupdate!'});
                    location.reload();
                }
            })
        })

    </script>


@endsection

@section('content')
    <div class="bg-body-light">
    <div class="bg-image" style="background-image: url('{{asset('media/avatars/background-profile.jpg')}}');">
          <div class="bg-primary-dark-op">
            <div class="content content-full text-center">
              <div class="my-3">
                <img class="img-avatar img-avatar-thumb" src="{{ asset ('media/avatars/profile.jpg')}}" alt="">
              </div>
              <h2 class="h4 fw-normal text-white-75">
                {{Auth::user()->name}}
              </h2>
              <a class="btn btn-alt-secondary" href="#">
                <i class="fa fa-fw fa-arrow-left text-danger"></i> Level : {{Auth::user()->role}}
              </a>
            </div>
          </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content content-boxed">
          <!-- User Profile -->
          <div class="block block-rounded">
            <div class="block-header block-header-default">
              <h3 class="block-title">User Profile</h3>
            </div>
            <div class="block-content">
              <form id="updateForm">
                <div class="row push">
                  <div class="col-lg-4">
                    <p class="fs-sm text-muted">
                      Your account’s vital info. Your username will be publicly visible.
                    </p>
                  </div>
                  <div class="col-lg-8 col-xl-5">
                    <div class="mb-4">
                      <label class="form-label" for="one-profile-edit-name">Name</label>
                      <input hidden type="text" class="form-control" id="id" name="id" value="{{Auth::user()->id}}">
                      <input type="text" class="form-control" id="edit-name" name="name" placeholder="Enter your name.." value="{{Auth::user()->name}}">
                    </div>
                    <div class="mb-4">
                      <label class="form-label" for="one-profile-edit-email">Email Address</label>
                      <input type="email" class="form-control" id="edit-email" name="email" placeholder="Enter your email.." value="{{Auth::user()->email}}">
                    </div>
                    <div class="mb-4">
                      <button type="submit" class="btn btn-alt-primary">
                        Update
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- END User Profile -->

          <!-- Change Password -->
          <div class="block block-rounded">
            <div class="block-header block-header-default">
              <h3 class="block-title">Change Password</h3>
            </div>
            <div class="block-content">
                <form method="POST" action="{{ route('changePassword') }}">
                  @csrf 

                <div class="row push">
                
                  <div class="col-lg-4">
                    <p class="fs-sm text-muted">
                      Changing your sign in password is an easy way to keep your account secure.
                    </p>
                    @foreach ($errors->all() as $error)
                      <p class="text-danger">{{ $error }}</p>
                    @endforeach
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                  </div>
                  <div class="col-lg-8 col-xl-5">
                    <div class="mb-4">
                      <label class="form-label" for="one-profile-edit-password">Current Password</label>
                      <input type="password" class="form-control" id="current_password" name="current_password">
                        
                    </div>
                    <div class="row mb-4">
                      <div class="col-12">
                        <label class="form-label" for="one-profile-edit-password-new">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password">
                      </div>
                    </div>
                    <div class="row mb-4">
                      <div class="col-12">
                        <label class="form-label" for="one-profile-edit-password-new-confirm">Confirm New Password</label>
                        <input type="password" class="form-control" id="new_confirm_password" name="new_confirm_password">
                      </div>
                    </div>
                    <div class="mb-4">
                      <button type="submit" class="btn btn-alt-primary">
                        Update
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
    </div>
    <!-- END Page Content -->

    


    


    

    
@endsection
