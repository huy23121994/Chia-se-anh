@extends('backend.layout.main')
@section('content')
<h1>All Album</h1>
    <div class="box box-primary">
        <div class="box-body">
            <table class="table table-hover table-classroom">
                <thead>
                <tr>
                    <th class="text-center row-number">#</th>
                    <th width="200">
                    @if ($sortby == 'title' && $order == 'asc')
                        {{ link_to_action('AlbumsController@index','Title',array('sortby' => 'title','order' => 'desc')) }}
                    @else
                        {{ link_to_action('AlbumsController@index','Title',array('sortby' => 'title','order' => 'asc')) }}
                    @endif
                    </th>
                    <th width="200">Preview</th>
                    <th width="200">Người Đăng</th>
                    <th width="200">Category</th>
                    <th width="200">Số ảnh</th>
                    <th width="200">Số like</th>
                    <th class="text-center" width="200">Thời gian đăng</th>
                    <th class="action" width="150">Action</th>

                </tr>
                </thead>
                <tbody>
                @if(count($albums) > 0)
                        {{  $i=1 }}

                    @foreach($albums as $item)
                        <tr>
                            <td class="text-center">{{ $i++ }}.</td>
                            <td>
                                {{ $item->title }}
                            </td>
                            <td>
                                <img src="{{url('public/'.$item->images->first()->path)}}" alt="{{$item->title}}" width="64" height="64" class="img-thumbnail">
                            </td>
                            <td>
                               {{-- {{ $item->album->user->name }} --}}
                               <a href="{{ url('user/edit/'.$item->user->id) }}">{{ $item->user->name }}</a>
                            </td>
                            <td>
                               {{ $item->category->title }}
                            </td>
                            <td>
                               {{ $item->images->count('id') }}
                            </td>
                            <td>
                               {{ $item->images->sum('count_like') }}
                            </td>
                            <td class="date">{{ e($item->created_at) }}</td>
                            <td>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">
                            Data empty
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        
        <div class="box-footer clearfix">
            <div class="box-tools">
                <div class="col-md-9 text-right">
                    {{$albums->links()}}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(".delete-btn").click(function(e){
                
                if(confirm("Xoa khong?")){

                }else{
                    e.preventDefault();
                }
            });
        });
    </script>
@stop
