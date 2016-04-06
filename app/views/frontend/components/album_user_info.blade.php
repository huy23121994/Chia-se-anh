
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
    @if($album->user_id == Session::get('current_user'))
    <li>
        <p><b>Description</b></p>
        <textarea class="form-control description" name='description'>{{ $album['description'] }}</textarea>
    </li>
    <li>
        <p><b>Category</b></p>
        <select class='form-control' name='category_id'>
            @foreach($categories as $category)
            <option value='{{$category->id}}'
                    @if($category->id == $image->album->category_id)
                    selected='true'
                    @endif
                    >{{$category->title}}</option>
            @endforeach
        </select>
    </li>
    
    @else
    <li>
        <p><b>Description</b></p>
        <p>{{ $album['description'] }}</p>
    </li>
    <li>
        <p><b>Category</b></p>
        <p>{{ $album->category->title}}</p>
    </li>
    @endif
  
</ul>
