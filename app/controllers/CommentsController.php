<?php

class CommentsController extends BaseController{
    
    public function index($id){
        
    }
    
    public function create(){
        
    }
    
    public function store(){
        if (Input::get('commentContent')) {
            $data = Input::all();
            $new = new Comment;
            $new->post_id = $data['post_id'];
            $new->user_id = Session::get('current_user');
            $new->p_type = $data['type'];
            $new->content = $data['commentContent'];
            $new->save();
            $new = $new->toArray();
            $new['user_name'] = User::where('id', '=', $new['user_id'])->get()->first()->name;
            echo json_encode($new);
        } else {
            echo json_encode('false');
        }
    }
}