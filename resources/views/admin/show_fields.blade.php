<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $user->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $user->name !!}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{!! $user->email !!}</p>
</div>

<!-- Role Field -->
<div class="form-group">
    {!! Form::label('role', 'Role:') !!}
    <p>{!! $user->role !!}</p>
</div>

<!-- Created at Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created:') !!}
    <p>{!! $user->created_at->diffForHumans() !!}</p>
</div>

<!-- Updated at Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Update:') !!}
    <p>{!! $user->updated_at->diffForHumans() !!}</p>
</div>



{{-- <! Change Role >
<div class="form-check">
    {!! Form::label('Facebook', 'Facebook:') !!}
    <p>@if($clients->Facebook =='Unsubscribed') <span style="color:red"> Unsubscribed </span>
                    @else($clients->Facebook =='subscribed') <span style="color:green"> Subscribed </span> @endif</p>
</div> --}}

