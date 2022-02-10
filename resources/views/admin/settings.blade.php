@section('page_name'){{ 'Settings' }}@endsection

@include('inc.header')

<form action="{{route('admin.settings')}}" method="post" enctype="multipart/form-data">
    @csrf
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="m-0">
                            @yield('page_name')
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
                                <label for="title" class="m-0 d-flex">
                                    <h3 class="card-title">
                                        Title <span class="text-danger">*</span>
                                    </h3>
                                </label>
                            </div>
                            <div class="card-body">
                                <input class="form-control" type="text" name="title" id="title" placeholder="Title" value="{{$settings['TITLE']}}" required>
                            </div>
                        </div>
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <label for="description" class="m-0 d-flex">
                                    <h3 class="card-title">
                                        Description
                                    </h3>
                                </label>
                            </div>
                            <div class="card-body">
                                <textarea class="form-control" name="description" id="description" cols="30" rows="10"
                                    placeholder="Description"></textarea>
                            </div>
                        </div>
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <label for="mail_mailer" class="m-0 d-flex">
                                    <h3 class="card-title">
                                        Mail Mailer <span class="text-danger">*</span>
                                    </h3>
                                </label>
                            </div>
                            <div class="card-body">
                                <select name="mail_mailer" class="custom-select">
                                    <option value="smtp" @if(setting('MAIL_MAILER') == 'smtp') selected @endif>SMTP</option>
                                    <option value="sendmail" @if(setting('MAIL_MAILER') == 'sendmail') selected @endif>Sendmail</option>
                                    <option value="mailgun" @if(setting('MAIL_MAILER') == 'mailgun') selected @endif>Mailgun</option>
                                    <option value="ses" @if(setting('MAIL_MAILER') == 'ses') selected @endif>Ses</option>
                                    <option value="log" @if(setting('MAIL_MAILER') == 'log') selected @endif>Log</option>
                                    <option value="array" @if(setting('MAIL_MAILER') == 'array') selected @endif>Array</option>
                                    <option value="failover" @if(setting('MAIL_MAILER') == 'failover') selected @endif>Failover</option>
                                </select>
                            </div>
                        </div>
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <label for="mail_host" class="m-0 d-flex">
                                    <h3 class="card-title">
                                        Mail Host <span class="text-danger">*</span>
                                    </h3>
                                </label>
                            </div>
                            <div class="card-body">
                                <input class="form-control" type="text" name="mail_host" id="mail_host" placeholder="Mail Host" value="{{$settings['MAIL_HOST']}}" required>
                            </div>
                        </div>
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <label for="mail_port" class="m-0 d-flex">
                                    <h3 class="card-title">
                                        Mail Port <span class="text-danger">*</span>
                                    </h3>
                                </label>
                            </div>
                            <div class="card-body">
                                <input class="form-control" type="number" name="mail_port" id="mail_port" placeholder="Mail Port" value="{{$settings['MAIL_PORT']}}" required>
                            </div>
                        </div>
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <label for="mail_username" class="m-0 d-flex">
                                    <h3 class="card-title">
                                        Mail Username <span class="text-danger">*</span>
                                    </h3>
                                </label>
                            </div>
                            <div class="card-body">
                                <input class="form-control" type="text" name="mail_username" id="mail_username" placeholder="Mail Username" value="{{$settings['MAIL_USERNAME']}}" required>
                            </div>
                        </div>
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <label for="mail_encryption" class="m-0 d-flex">
                                    <h3 class="card-title">
                                        Mail Encryption <span class="text-danger">*</span>
                                    </h3>
                                </label>
                            </div>
                            <div class="card-body">
                                <input class="form-control" type="text" name="mail_encryption" id="mail_encryption" placeholder="Mail Encryption" value="{{$settings['MAIL_ENCRYPTION']}}" required>
                            </div>
                        </div>
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <label for="mail_from_address" class="m-0 d-flex">
                                    <h3 class="card-title">
                                        Mail From Address <span class="text-danger">*</span>
                                    </h3>
                                </label>
                            </div>
                            <div class="card-body">
                                <input class="form-control" type="text" name="mail_from_address" id="mail_from_address" placeholder="Mail From Address" value="{{$settings['MAIL_FROM_ADDRESS']}}" required>
                            </div>
                        </div>
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <label for="mail_password" class="m-0 d-flex">
                                    <h3 class="card-title">
                                        Mail Password
                                    </h3>
                                </label>
                            </div>
                            <div class="card-body">
                                <input class="form-control" type="password" name="mail_password" id="mail_password" placeholder="Mail Password">
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
