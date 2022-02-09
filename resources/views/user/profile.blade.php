@section('page_name'){{ 'Profile' }}@endsection

@include('inc.header')

<form action="{{route('user.profile')}}" method="post">
    @csrf

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('page_name')
                            <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                                title="Save"><i class="fas fa-save"></i></button>
                        </h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <label for="name" class="m-0 d-flex">
                                    <h3 class="card-title">
                                        Name <span class="text-danger">*</span>
                                    </h3>
                                </label>
                            </div>
                            <div class="card-body">
                                <input class="form-control" type="text" name="name" id="name" placeholder="Name"
                                    value="{{Auth::user()->name}}" required>
                            </div>
                        </div>
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <label for="email" class="m-0 d-flex">
                                    <h3 class="card-title">
                                        Email <span class="text-danger">*</span> (Verified:
                                        {{if_null(Auth::user()->email_verified_at)}})
                                    </h3>
                                </label>
                            </div>
                            <div class="card-body">
                                <input class="form-control" type="email" name="email" id="email" placeholder="Email"
                                    value="{{Auth::user()->email}}" required>
                            </div>
                        </div>
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <label for="current_password" class="m-0 d-flex">
                                    <h3 class="card-title">
                                        Current Password
                                    </h3>
                                </label>
                            </div>
                            <div class="card-body">
                                <input class="form-control" type="password" name="current_password" id="current_password"
                                    placeholder="Current Password">
                            </div>
                        </div>
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <label for="new_password" class="m-0 d-flex">
                                    <h3 class="card-title">
                                        New Password
                                    </h3>
                                </label>
                            </div>
                            <div class="card-body">
                                <input class="form-control" type="password" name="new_password" id="new_password"
                                    placeholder="New Password">
                            </div>
                        </div>
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <label for="new_password_confirmation" class="m-0 d-flex">
                                    <h3 class="card-title">
                                        New Password Confirmation
                                    </h3>
                                </label>
                            </div>
                            <div class="card-body">
                                <input class="form-control" type="password" name="new_password_confirmation"
                                    id="new_password_confirmation" placeholder="New Password Confirmation">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</form>

@include('inc.footer')
