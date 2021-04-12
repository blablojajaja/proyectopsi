
@foreach($replies as $reply)
        <div class="container border border-success">
                <strong>{{ $reply->user->name }}</strong>
                <p>{{ $reply->created_at }}</p>

                <p>{{ $reply->text }}</p>
        </div>
        </br>
@endforeach