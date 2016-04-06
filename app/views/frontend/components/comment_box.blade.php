@if(Session::has('current_user'))
<form action="{{url('comment')}}" id="comment-form" method="POST">
    <input type="hidden" name="post_id" value="{{$post->id}}">
    <input type="hidden" name="type" value="2">
    <ul>
        <li>
            <p><b>Comment</b></p>
            <textarea class="form-control comment-conent" name="commentContent" placeholder="Comment here..."></textarea>
        </li>
        <li>
            <button class="btn btn-danger submit" name="submit" value=''>Submit</button>
        </li>
    </ul>
</form>
@else
<ul>
    <li>
        <p>(Please login to comment)</p>
    </li>
</ul>  
@endif
<div class='clearfix'></div>
<div class="detailBox">
    <div class="titleBox">
        <label>Comment Box</label>
        <span class='glyphicon glyphicon-chevron-up'></span>
    </div>
    <div class="actionBox">
        <ul class="commentList">
            @foreach ($post->comments as $comment)
            <li>
                <p>
                    
                    <b>{{$comment->user->name}}</b>
                    
                </p>
                <div class="commentText ">
                    <span class="comment-view form-control">{{$comment->content}}</span>
                    <span class="date sub-text">on {{$comment->created_at}}</span>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
