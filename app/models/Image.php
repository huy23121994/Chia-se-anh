<?php

class Image extends Eloquent{
    protected $table = 'images';

    
    public function album(){
        return $this->belongsTo('Album', 'album_id');
    }
    
    public function comments(){
        return $this->hasMany('Comment', 'post_id')->where('p_type','=',2)->orderBy('created_at', 'desc');
    }
    
    public function actions(){
        return $this->hasMany('Action', 'post_id')->where('a_type','=',2);
    }
    
}