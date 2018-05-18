<form method="POST" action="/admin/{{ $comment->id }}/updatecomment">
    {{ csrf_field() }}


    <div class="form-group col-sm-8">
        {!! Form::label('body', 'Body:') !!}
        {!! Form::textarea('body', $comment->body, ['class' => 'form-control']) !!}
    </div>


    <div class="form-group col-sm-8">

        <strong>Create Date:</strong>

        <input disabled class="form-control" type="date" name="created_at"
               value="{{ \Carbon\Carbon::parse($comment->created_at)->format('Y-m-d')}}">
    </div>


    <div class="form-group col-sm-8">

        <strong>Update Date:</strong>

        <input disabled class="form-control" type="date" name="updated_at"
               value="{{ \Carbon\Carbon::parse($comment->updated_at)->format('Y-m-d')}}">
    </div>


    <div class="form-check col-sm-8">

        @if($comment->status == "activated")

            <input class="form-check-input" checked id="status" name="status" type="hidden" name="check[0]"
                   value="deactivated"/>
            <input class="form-check-input" checked id="status" name="status" type="checkbox" name="check[0]"
                   value="activated"/>
            <label class="form-check-label" for="status">
                Active
            </label>

        @else

            <input class="form-check-input" id="status" name="status" type="hidden" name="check[0]"
                   value="deactivated"/>
            <input class="form-check-input" id="status" name="status" type="checkbox" name="check[0]"
                   value="activated"/>
            <label class="form-check-label" for="status">
                Active
            </label>

        @endif

    </div>

    <div class="form-group col-sm-8">
        <button class='btn btn-primary btn-xs'>Save</button>
        <a href="/admin/comments" class='btn btn-default btn-xs'>Cancel</a>
    </div>
</form>
