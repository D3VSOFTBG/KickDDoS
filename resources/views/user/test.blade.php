@section('page_name'){{ 'Test' }}@endsection

@include('inc.header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">@yield('page_name')</h1>
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
                            <h3 class="card-title">
                                Your have {{null_to_0(Auth::user()->concurrent)}}/{{$test_count}} concurrents and {{null_to_0(Auth::user()->seconds)}} seconds.
                            </h3>
                        </div>
                        <div class="card-body">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-link active" id="nav-3-tab" data-toggle="tab" href="#nav-3"
                                        role="tab" aria-controls="nav-3" aria-selected="true">3</a>
                                    <a class="nav-link" id="nav-4-tab" data-toggle="tab" href="#nav-4"
                                        role="tab" aria-controls="nav-4" aria-selected="false">4</a>
                                    <a class="nav-link" id="nav-7-tab" data-toggle="tab" href="#nav-7"
                                        role="tab" aria-controls="nav-7" aria-selected="false">7</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-3" role="tabpanel"
                                    aria-labelledby="nav-3-tab">
                                    <form action="{{route('user.test')}}" method="post">
                                        @csrf
                                        <div class="mt-3">
                                            <div class="form-group">
                                                <label for="host">
                                                    Host <span class="text-danger">*</span>
                                                </label>
                                                <input name="host" type="text" class="form-control" placeholder="Host"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="port">
                                                    Port <span class="text-danger">*</span>
                                                </label>
                                                <input name="port" type="number" class="form-control" placeholder="Port"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="seconds">
                                                    Seconds <span class="text-danger">*</span>
                                                </label>
                                                <input name="seconds" type="number" class="form-control"
                                                    placeholder="Seconds" min="0" max="{{null_to_0(Auth::user()->seconds)}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="method_id">
                                                    Method <span class="text-danger">*</span>
                                                </label>
                                                <select name="method_id" class="custom-select">
                                                    @foreach ($methods as $method)
                                                        @if ($method->layer == 3)
                                                            <option value="{{$method->id}}">{{$method->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="nav-4" role="tabpanel"
                                    aria-labelledby="nav-4-tab">
                                    <form action="{{route('user.test')}}" method="post">
                                        @csrf
                                        <div class="mt-3">
                                            <div class="form-group">
                                                <label for="host">
                                                    Host <span class="text-danger">*</span>
                                                </label>
                                                <input name="host" type="text" class="form-control" placeholder="Host"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="port">
                                                    Port <span class="text-danger">*</span>
                                                </label>
                                                <input name="port" type="number" class="form-control" placeholder="Port"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="seconds">
                                                    Seconds <span class="text-danger">*</span>
                                                </label>
                                                <input name="seconds" type="number" class="form-control"
                                                    placeholder="Seconds" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="method_id">
                                                    Method <span class="text-danger">*</span>
                                                </label>
                                                <select name="method_id" class="custom-select">
                                                    @foreach ($methods as $method)
                                                        @if ($method->layer == 4)
                                                            <option value="{{$method->id}}">{{$method->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="nav-7" role="tabpanel"
                                    aria-labelledby="nav-7-tab">
                                    <form action="{{route('user.test')}}" method="post">
                                        @csrf
                                        <div class="mt-3">
                                            <div class="form-group">
                                                <label for="host">
                                                    Host <span class="text-danger">*</span>
                                                </label>
                                                <input name="host" type="text" class="form-control" placeholder="Host" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="port">
                                                    Port <span class="text-danger">*</span>
                                                </label>
                                                <input name="port" type="number" class="form-control" placeholder="Port" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="seconds">
                                                    Seconds <span class="text-danger">*</span>
                                                </label>
                                                <input name="seconds" type="number" class="form-control" placeholder="Seconds" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="method_id">
                                                    Method <span class="text-danger">*</span>
                                                </label>
                                                <select name="method_id" class="custom-select">
                                                    @foreach ($methods as $method)
                                                        @if ($method->layer == 7)
                                                            <option value="{{$method->id}}">{{$method->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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

@include('inc.footer')
