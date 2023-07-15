@foreach ($comments as $key => $comment)
    <div class="item-comment">
        <img src="{{ asset('storage/'. $comment->user->avatar) }}" alt="">
        <div class="info-comment">
            <h3>{{ $comment->user->user_name }}</h3>
            @can ('update', $comment)
                <form action="{{ route('comment.update', ['comment' => $comment]) }}" method="POST" class="form-edit-comment">
                    @method("PUT")
                    @csrf
                    <textarea name="content" id="" class="textarea-update item-form-edit">{{ $comment->content }}</textarea>
                    <button class="item-form-edit">{{ __('comment.btn_save') }}</button>
                </form>
                <p class="content-my-comment">{{ $comment->content }}</p>
            @else
                <p class="content-comment">{{ $comment->content }}</p>
            @endcan
            <p class="time-comment">{{ $comment->created_at->diffForHumans() }}</p>
        </div>
        @canany (['update', 'delete'], $comment)
            <i class="fa-solid fa-ellipsis-vertical icon-option-comment"></i>
            <form action="{{ route('comment.delete', ['comment' => $comment]) }}" method="POST" class="box-option-comment">
                @method("DELETE")
                @csrf
                <p class="item-option-comment option-edit">{{ __('comment.option_edit') }}</p>
                <button type='submit' class="item-option-comment" >{{ __('comment.option_delete') }}</button>
            </form>
        @endcan
    </div>
@endforeach
