<?php
class AlbumsController extends BaseController{
    
    public function create(){
        return View::make('frontend/albums/create');
    }
    
    public function store(){
        $data = Input::all();
        $data['is_single'] = 0;
        $album = AlbumsHelper::save($data);
        
        $filesStatus = Input::get('file_status');
        $upload_folder = "upload/albums/". uniqid(date('ymdHisu'));
        $files = Input::file('path');
        $captions = Input::get('caption');
        $status = 'success';
        foreach($files as $index => $file){
            if($file->isValid() && $filesStatus[$index] != 0) {
                $image = new Image;
                $name= $file->getFilename().uniqid().".".$file->getClientOriginalExtension();
                $file->move(public_path() ."/". $upload_folder,$name);
                $image->path= $upload_folder."/".$name;
                $image->caption = $captions[$index];
                $image->album_id = $album->id;
                $status = $image->save();
                if($status == FALSE){
                    $status = 'fail';
                    break;
                }
            }
        }
        Session::flash('status',$status);
        return Redirect::to('album/create');
    }
    
    public function show($id){
        $album = Album::where('id', $id)->first();
        if($album->user_id == Session::get('current_user')){
            return Redirect::to('album/'.$album->id.'/edit')->with('album',$album);
        }else{
            return View::make('frontend/albums/show')->with('album',$album);
        }
        
    }

    public function edit($id){
        $album = Album::find($id);
        return View::make('frontend/albums/edit')->with('album',$album);
    }


    public function index(){
        $datas = Input::all();
        $params = array();
        if(isset($datas['u'])){
            $params['user_id'] = $datas['u'];
        }
        if(isset($datas['title'])){
            $params['title'] = $datas['title'];
        }
        if(isset($datas['category'])){
            $params['category_id'] = $datas['category'];
        }
        $albums_d = Album::where('public','=','1');
        foreach($params as $key => $param){
            if($key == 'title'){
                $op = 'LIKE';
                $param = "%".$param."%";
            }
            if($key == 'user_id' || $key == 'category_id'){
                $op = '=';
            }
            $albums_d = Album::where($key,$op,$param);
        }
        $albums = $albums_d->get();
        if( !empty($params['user_id'])){
            $view =  View::make('frontend/albums/my-images')->with('albums',$albums);
        }else{
            $view =  View::make('frontend/index')->with('albums',$albums);
        }
        if(!empty($params['category_id'])){
            $view->with('category_title', Category::find($params['category_id'])->title);
        }
        return $view;
        
    }
    
}