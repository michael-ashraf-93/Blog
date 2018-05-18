@extends('.admin.layouts.master')

@section('content')
<section class="content-header">
    <h1>
        Show User
    </h1>
</section>
<div class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="row" style="padding-left: 20px">
                @include('admin.show_fields')
                <a href="/admin" class="btn btn-default">Back</a>
                <a href="/admin/{{$user->id}}/edit" class='btn btn-primary'><i class="glyphicon glyphicon-edit"></i></a>

            </div>
        </div>
    </div>
</div>
@endsection