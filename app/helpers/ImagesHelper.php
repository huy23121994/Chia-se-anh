<?php

class ImagesHelper{
    public static function save($data, $id = null) {
        if ($id != null) {
            $image = Image::find($id);
        } else {
            $image = new Image;
        }
        $image->path = $data['path'];
        $image->album_id = $data['album_id'];
        $image->caption = $data['caption'];
        if($image->save()) return $image;
    }

}