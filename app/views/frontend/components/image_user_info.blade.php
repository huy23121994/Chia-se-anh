<ul>
    <li>
        <p><b>Upload by</b></p>
        <p>
            <a href="{{url('user/'.$image->album->user->id)}}" class="user_name">
                <p>{{$image->album->user->name}}</p>
                <div ><img class='img-rounded avatar' src='{{url($image->album->user->avatar)}}'></div>
            </a>
        </p>
    </li>
    @if($image->album->user->id != Session::get('current_user'))
    <li>
        <p><b>Category</b></p>
        <p>{{ $image->album->category->title}}</p>
    </li>
    @else
    <li>
        <p><b>Category</b></p>
        <p>
            <select class='form-control' name='category_id'>
                @foreach($categories as $category)
                <option value='{{$category->id}}'
                        @if($category->id == $image->album->category_id)
                        selected='true'
                        @endif
                        >{{$category->title}}</option>
                @endforeach
            </select>
        </p>
    </li>
    @endif
</ul>
