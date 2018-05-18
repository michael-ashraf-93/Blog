@extends('.admin.layouts.master')

@section('content')
    <section class="content-header">
        @include('layouts.errors')

        <h1>
            Edit Post
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    @include('admin.commentfieldsedite')

                </div>
            </div>
        </div>
    </div>
@endsection