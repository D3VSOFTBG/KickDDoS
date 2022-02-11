@section('page_name'){{ 'Users' }}@endsection

@include('inc.header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <form action="{{route('admin.users.create')}}" method="post" enctype="multipart/form-data">
        @csrf
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="m-0">
                            @yield('page_name')
                            <a data-toggle="modal" data-target="#create">
                                <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                                    title="Create"><i class="fas fa-user-plus"></i></button>
                            </a>
                        </h1>
                        <!-- Modal -->
                        <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
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
                                            <label for="email">
                                                Email <span class="text-danger">*</span>
                                            </label>
                                            <input name="email" id="email" type="email" class="form-control"
                                                placeholder="Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="is_admin">
                                                Admin <span class="text-danger">*</span>
                                            </label>
                                            <select name="is_admin" class="custom-select">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="concurrents">
                                                Concurrents <span class="text-danger">*</span>
                                            </label>
                                            <input name="concurrents" id="concurrents" type="number" class="form-control"
                                                placeholder="Concurrents" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="seconds">
                                                Seconds <span class="text-danger">*</span>
                                            </label>
                                            <input name="seconds" id="seconds" type="number" class="form-control"
                                                placeholder="Seconds" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="expired_at">
                                                Expired <span class="text-danger">*</span>
                                            </label>
                                            <input type="datetime-local" class="form-control" id="expired_at" name="expired_at" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">
                                                Password <span class="text-danger">*</span>
                                            </label>
                                            <input name="password" id="password" type="password" class="form-control"
                                                placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation">
                                                Password Confirmation <span class="text-danger">*</span>
                                            </label>
                                            <input name="password_confirmation" id="password_confirmation"
                                                type="password" class="form-control" placeholder="Password Confirmation"
                                                required>
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
                                There are {{$users->total()}} users.
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
                                            Email
                                        </th>
                                        <th class="align-middle">
                                            Role
                                        </th>
                                        <th class="align-middle">
                                            Expired
                                        </th>
                                        <th class="align-middle">
                                            Created
                                        </th>
                                        <th class="align-middle">
                                            Updated
                                        </th>
                                        <th class="align-middle">
                                            Actions
                                        </th>
                                    </tr>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td class="align-middle">
                                            {{$user->id}}
                                        </td>
                                        <td class="align-middle">
                                            {{$user->name}}
                                        </td>
                                        <td class="align-middle">
                                            {{$user->email}}
                                        </td>
                                        <td class="align-middle">
                                            {{is_admin($user->is_admin)}}
                                        </td>
                                        <td class="align-middle">
                                            {{if_null($user->expired_at)}}
                                        </td>
                                        <td class="align-middle">
                                            {{if_null($user->created_at)}}
                                        </td>
                                        <td class="align-middle">
                                            {{if_null($user->updated_at)}}
                                        </td>
                                        <td class="align-middle">
                                            <form action="{{route('admin.users.edit')}}" method="post" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$user->id}}">
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit{{$user->id}}"><i
                                                        class="fas fa-user-edit"></i></button>
                                                <div class="modal fade" id="edit{{$user->id}}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit #{{$user->id}}</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="name">
                                                                        Name <span class="text-danger">*</span>
                                                                    </label>
                                                                    <input name="name" id="name" type="text" class="form-control"
                                                                        placeholder="Name" value="{{$user->name}}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="email">
                                                                        Email <span class="text-danger">*</span>
                                                                    </label>
                                                                    <input name="email" id="email" type="email" class="form-control"
                                                                        placeholder="Email" value="{{$user->email}}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="is_admin">
                                                                        Admin <span class="text-danger">*</span>
                                                                    </label>
                                                                    <select name="is_admin" class="custom-select">
                                                                        <option value="0" @if ($user->is_admin == 0) selected @endif>No</option>
                                                                        <option value="1" @if ($user->is_admin == 1) selected @endif>Yes</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="concurrents">
                                                                        Concurrents <span class="text-danger">*</span>
                                                                    </label>
                                                                    <input name="concurrents" id="concurrents" type="number" class="form-control"
                                                                        placeholder="Concurrents" value="{{$user->concurrents}}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="seconds">
                                                                        Seconds <span class="text-danger">*</span>
                                                                    </label>
                                                                    <input name="seconds" id="seconds" type="number" class="form-control"
                                                                        placeholder="Seconds" value="{{$user->seconds}}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="expired_at">
                                                                        Expired <span class="text-danger">*</span>
                                                                    </label>
                                                                    <input type="datetime-local" class="form-control" id="expired_at" name="expired_at" value="{{datetime_local($user->expired_at)}}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="password">
                                                                        Password
                                                                    </label>
                                                                    <input name="password" id="password" type="password" class="form-control"
                                                                        placeholder="Password">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="password_confirmation">
                                                                        Password Confirmation
                                                                    </label>
                                                                    <input name="password_confirmation" id="password_confirmation"
                                                                        type="password" class="form-control" placeholder="Password Confirmation">
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
                                            </form>

                                            <form action="{{route('admin.users.delete')}}" method="post"
                                                class="d-inline"
                                                onsubmit="if(!confirm('Delete (#{{$user->id}}).')){return false;}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$user->id}}">
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
                            {{$users->links()}}
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
