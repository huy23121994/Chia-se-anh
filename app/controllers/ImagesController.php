<?php
class ImagesController extends BaseController{
    public function show($id){
        $image = Image::where('id',$id)->first();
        if($image->album->user_id == Session::get('current_user')){
            return Redirect::to('image/'.$image->id.'/edit')->with('image',$image);
        }else{
            return View::make('frontend/images/show')->with('image',$image);
        }
    }
    
    public function edit($id){
        $image = Image::where('id',$id)->first();
        return View::make('frontend/images/edit')->with('image',$image);
    }
    
    public function update($id){
        $data = Input::all();
        $image = Image::where('id',$id)->first();
        if(AlbumsHelper::save($data, $image->album->id)){
            $image->caption = $data['caption'];
            if($image->save()){
                Session::flash('status','success');
                Session::flash('messages',array(0 => 'Updated'));
            }else{
                Session::flash('status','fail');
                Session::flash('messages',array(0 => 'Failed'));
            }
            return Redirect::to('image/'.$image->id.'/edit');
        }
    }
    
    public function store(){
        $files = Input::file('path');
        $filesStatus = Input::get('file_status');
        $status = 'success';
        if($files == null){
            Session::flash('status','false');
            $errors_message[] = "Over max upload size!";
            Session::flash('errors_message',$errors_message);
            return Redirect::to('user/upload')->header('Cache-Control', 'no-store, no-cache');;
        }
        foreach($files as $index => $file){
            if($file->isValid() && $filesStatus[$index] != 0) {
                $album = $this->saveAlbum($index);
                if($album){
                    if(!$this->saveImage($index, $album->id)){
                        $status = 'false';
                        break;
                    }
                }else{
                    $status = 'false';
                    break;
                }
            }
        }
        Session::flash('status',$status);
        return Redirect::to('album/create')->header('Cache-Control', 'no-store, no-cache');;
    }
    
    public function destroy($id){
        $image = Image::find($id);
        if($image){
            $image->album->delete();
            $image->delete();
            Session::flash('status','success');
            Session::put('message',array('0' => 'Successed'));
            return Redirect::to('album?u='.Session::get('current_user'));
        }else{
            Session::flash('status','fail');
            Session::put('message',array('0' => 'Failed'));
            return Redirect::to('image/'.$id);
        }
    }
    
    private function saveAlbum($index){
        $categories = Input::get('category');
        $publices = Input::get('public');
        $titles = Input::get('title');
        $files = Input::file('path');
        $file = $files[$index];
        if($file->isValid()) {
            $data['category_id'] = $categories[$index];
            $data['user_id'] = Session::get('current_user');
            $data['public'] = $publices[$index];
            $data['title'] = $titles[$index];
            $data['description'] = "";
            $data['is_single'] = 1;
            return AlbumsHelper::save($data);
        }
        return false;
    }
    
    private function saveImage($index, $album_id){
        $files = Input::file('path');
        $file = $files[$index];
        $name = $file->getFilename().uniqid().".".$file->getClientOriginalExtension();
        $upload_folder = "upload/images/". uniqid(date('ymdHisu'));
        $data['path'] = $upload_folder."/".$name;
        $data['album_id'] = $album_id;
        $captions = Input::get('caption');
        $data['caption'] = $captions[$index];
        App::make('FilesController')->save($file, $upload_folder, $name);
        return ImagesHelper::save($data);
    }
    
    
    
}
