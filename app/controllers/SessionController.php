<?php
class SessionController extends BaseController{
    public function store(){
        if (Input::get('account') && Input::get('password')) {
            $data = Input::all();
            $user = User::where('account', $data['account'])->where('password', $data['password'])->first();
            if ($user) {
                Session::put('current_user', $user->id);
                echo 'success';
            } else {
                echo 'fail';
            }
        }
    }
    
    public function destroy(){
        if (Session::has('current_user')) {
            Session::forget('current_user');
        }
        return Redirect::to('/home');
    }
}