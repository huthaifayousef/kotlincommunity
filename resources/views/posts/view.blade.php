

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{!!$posts->title!!}</div>
                <div class="panel-heading"><a target="__blank" href="{{ route('view_user',$user->username) }}">{{$user->name}}</a></div>


                <div class="panel-body">
                    {!!$posts->body!!}
                </div>
    <button id="upvote" class="btn btn-primary" onclick="upvote({{$posts->id}})">Upvote</button>
    <button id="upvote" class="btn btn-primary" onclick="downvote({{$posts->id}})">DownVote</button>

            </div>
        </div>
    </div>
    @foreach($answers as $answer)
    <div class="row">
        <div class="col-md-3">
            <button id="upvote" class="btn btn-primary" onclick="upvote_answer({{$answer->id}})">Upvote</button>
            <button id="upvote" class="btn btn-primary" onclick="downvote_answer({{$answer->id}})">DownVote</button>
        </div><br>
    	<div class="col-md-2">{{$answer->name}}</div>
        <div class="col-md-2">{{$answer->body}}</div>
    	<div class="col-md-2"><a target="__blank" href="{{ route('view_user',$answer->username) }}">{{$answer->username}}</a></div>
    </div>
    @endforeach
    {{ $answers->links() }}
    <div class="row">
        <div class="col-md-10">
        	<form method="post">
              	{{ csrf_field() }}
        		<div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                    <label for="title" class="col-md-4 control-label">Answer Body</label>
                    <div class="col-md-6">
                        <textarea id="body"  class="form-control" name="body"  required autofocus>
                        	{{ old('body') }}
                        </textarea>

                        @if ($errors->has('body'))
                            <span class="help-block">
                                <strong>{{ $errors->first('body') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group" id="add_comment" style="margin-top: 20px;padding-top: 30px ">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary pull-right" style="margin-top: 10px">
                            Add Answer
                        </button>
                    </div>
                </div>
        	</form>
        </div>
    </div>
</div>

@endsection
@section('load_scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">
function upvote(post_id){
    $.ajax({
        type: "POST",
        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url:  '/interactions/upvote/'+post_id+'/1' ,
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}

function downvote(post_id){
    $.ajax({
        type: "POST",
        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url:  '/interactions/downvote/'+post_id+'/1',
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}

function downvote_answer(answer_id){
    $.ajax({
        type: "POST",
        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url:  '/interactions/downvote/'+answer_id+'/2' ,
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}

function upvote_answer(answer_id){
    $.ajax({
        type: "POST",
        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url:  '/interactions/upvote/'+answer_id+'/2' ,
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}
</script>
@endsection