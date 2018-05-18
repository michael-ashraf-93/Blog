{{--@extends('.admin.layouts.master')--}}

{{--@section('content')--}}

    {{--<table class="table table-responsive" id="clients-table">--}}
        {{--<thead>--}}
        {{--<tr>--}}
            {{--<th>Name</th>--}}
            {{--<th>Uset ID</th>--}}
            {{--<th>IP</th>--}}
            {{--<th>User Agent</th>--}}
            {{--<th>Pay Load</th>--}}
            {{--<th>Last Activity</th>--}}


        {{--</tr>--}}
        {{--</thead>--}}
        {{--<tbody>--}}

        {{--@foreach ($activities as $activity)--}}
            {{--<tr>--}}

                {{--<td>{!! $activity->user->name !!}</td>--}}
                {{--<td>{!! $session->user_id !!}</td>--}}
                {{--<td>{!! $session->ip_address !!}</td>--}}
                {{--<td>{!! $session->user_agent !!}</td>--}}
                {{--<td>{!! $session->payload !!}</td>--}}
                {{--<td>{!! $session->lastactivity !!}</td>--}}

            {{--</tr>--}}
        {{--@endforeach--}}
        {{--</tbody>--}}
    {{--</table>--}}
{{--@endsection--}}



@extends('.admin.layouts.master')

@section('content')




    <section class="content-header">
        <h1 class="pull-left">Posts</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="/posts/create">Add
                New Post</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">

                <table class="table table-responsive" id="clients-table">
                    <thead>
                    <tr>
                        <th>Active User</th>



                    </tr>
                    </thead>
                    <tbody>
                    @foreach($activities as $activity)
                        <tr>
                            <td>{!! $activity->user->name !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection