<?php

class AlbumsHelper{
    /*
     * @var id: id of album
     * @data: array of fields in Album
     */
    public static function save($data, $id = null){
        if($id == null){
            $album = new Album;
            $album->category_id = $data['category_id'];
            $album->user_id = Session::get('current_user');
            $album->public = $data['public'];
            $album->title = $data['title'];
            $album->description = $data['description'];
            $album->is_single = $data['is_single'];
        }else{
            $album = Album::find($id);
            $album->title = $data['title'];
            $album->description = isset($data['description'])?$data['description']:"";
            $album->category_id = $data['category_id'];
        }
        if($album->save()) return $album;
    }
}