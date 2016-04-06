<?php

class Album extends Eloquent{
    protected $table = 'albums';
    
    public function user(){
        return $this->belongsTo('User','user_id');
    }
    
    public function images(){
        return $this->hasMany('Image', 'album_id');
    }
    
    public function getImages($option = array()){
        $images = Image::where("album_id",$this->id)->get();
        
        if(!empty($option['width'])){
            foreach($images as $index => $image){
                $width = getimagesize(public_path() ."/".$image->path)[0];
                if($width > $option['width']){
                    $images->forget($index);
                }
            }
        }
        if(!empty($option['height'])){
            foreach($images as $index => $image){
                $height = getimagesize(public_path() ."/".$image->path)[1];
                if($height > $option['width']){
                    $images->forget($index);
                }
            }
        }
        if($images->count() == 0){
            return array();
        }else{
            return $images;
        }
    }

    public function category(){
    	return $this->belongsTo('Category','category_id');
    }
    
    public function actions(){
        return $this->hasMany('Action', 'post_id')->where('a_type','=',1);
    }
    
    public function comments(){
        return $this->hasMany('Comment', 'post_id')->where('p_type','=',1)->orderBy('created_at', 'desc');
    }
}