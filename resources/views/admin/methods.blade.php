@section('page_name'){{ 'Methods' }}@endsection

@include('inc.header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <form action="{{route('admin.methods.create')}}" method="post">
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
                                            <label for="name">
                                                Name <span class="text-danger">*</span>
                                            </label>
                                            <input name="name" id="name" type="text" class="form-control"
                                                placeholder="Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="layer">
                                                Layer <span class="text-danger">*</span>
                                            </label>
                                            <select name="layer" class="custom-select">
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="7">7</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="command">
                                                Command <span class="text-danger">*</span>
                                            </label>
                                            <input name="command" id="command" type="text" class="form-control"
                                                placeholder="Command" required>
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
                                There are {{$methods->total()}} methods.
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
                                            Name
                                        </th>
                                        <th class="align-middle">
                                            Layer
                                        </th>
                                        <th class="align-middle">
                                            Command
                                        </th>
                                        <th class="align-middle">
                                            Actions
                                        </th>
                                    </tr>
                                    @foreach ($methods as $method)
                                    <tr>
                                        <td class="align-middle">
                                            {{$method->id}}
                                        </td>
                                        <td class="align-middle">
                                            {{$method->name}}
                                        </td>
                                        <td class="align-middle">
                                            {{$method->layer}}
                                        </td>
                                        <td class="align-middle">
                                            {{$method->command}}
                                        </td>
                                        <td class="align-middle">
                                            <form action="{{route('admin.methods.delete')}}" method="post"
                                                class="d-inline"
                                                onsubmit="if(!confirm('Delete (#{{$method->id}}).')){return false;}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$method->id}}">
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
                            {{$methods->links()}}
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
