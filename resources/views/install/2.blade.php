@include('install.inc.header')

<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="#" class="h1"><b>KickDDoS</b> Install</a>
        </div>
        <div class="card-body">
            <p class="text-center">Create database tables.</p>

            <form action="{{route('install.2')}}" method="post">
                @csrf
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Next</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>

@include('install.inc.footer')
