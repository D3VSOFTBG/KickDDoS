@section('page_name'){{ 'Servers' }}@endsection

@include('inc.header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <form action="{{route('admin.servers.create')}}" method="post">
        @csrf
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('page_name')
                            <a data-toggle="modal" data-target="#create">
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                                    title="Create"><i class="fas fa-plus"></i></button>
                            </a>
                        </h1>
                        <!-- Modal -->
                        <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="username">
                                                Username <span class="text-danger">*</span>
                                            </label>
                                            <input name="username" id="username" type="text" class="form-control"
                                                placeholder="Username" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="host">
                                                Host <span class="text-danger">*</span>
                                            </label>
                                            <input name="host" id="host" type="text" class="form-control"
                                                placeholder="Host" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="port">
                                                Port <span class="text-danger">*</span>
                                            </label>
                                            <input name="port" id="port" type="number" class="form-control"
                                                placeholder="Port" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">
                                                Password <span class="text-danger">*</span>
                                            </label>
                                            <input name="password" id="password" type="text" class="form-control"
                                                placeholder="Password" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    </form>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                There are {{$servers->total()}} servers.
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered m-0">
                                    <tr>
                                        <th class="align-middle" style="width: 0;">
                                            #
                                        </th>
                                        <th class="align-middle">
                                            Username
                                        </th>
                                        <th class="align-middle">
                                            Host
                                        </th>
                                        <th class="align-middle">
                                            Port
                                        </th>
                                        <th class="align-middle">
                                            Actions
                                        </th>
                                    </tr>
                                    @foreach ($servers as $server)
                                    <tr>
                                        <td class="align-middle">
                                            {{$server->id}}
                                        </td>
                                        <td class="align-middle">
                                            {{$server->username}}
                                        </td>
                                        <td class="align-middle">
                                            {{$server->host}}
                                        </td>
                                        <td class="align-middle">
                                            {{$server->port}}
                                        </td>
                                        <td class="align-middle">
                                            <form action="{{route('admin.servers.delete')}}" method="post"
                                                class="d-inline"
                                                onsubmit="if(!confirm('Delete (#{{$server->id}}).')){return false;}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$server->id}}">
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            {{$servers->links()}}
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
