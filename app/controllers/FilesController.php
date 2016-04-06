<?php

class FilesController extends BaseController{
    public function save($file, $upload_folder, $name){
            $file->move(public_path() ."/". $upload_folder,$name);
    }
}
