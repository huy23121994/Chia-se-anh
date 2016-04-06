<?php
define('AVATAR_PATH', 'upload/avatars');
define('DEFAULT_AVATAR_PATH',"public/upload/avatars/default/avatar.jpg");
class UsersController extends BaseController {
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        if (Session::get('current_user')) {
            return View::make('frontend/index');
        }
        return View::make('frontend/users/create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        if ($this->validateSignUpInfo()) {
            Session::flash('signup_status', false);
            return Redirect::to('signup');
        } else {
            if (!UsersHelper::isExistedUser()) {
                $new = UsersHelper::saveNewUser();
                if ($new) {
                    Session::flash('signup_status', true);
                    Session::set("current_user", $new->id);
                    return Redirect::to('home');
                } else {
                    return Redirect::to('signup');
                }
            } else {
                return Redirect::to('signup');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        // $user = User::select('*')->where('id','=',$id)->first();
        // return View::make('backend.users.edit')->with('user',$user);
        $user = User::find($id);
        if (is_null($user)) {
            return Redirect::to('frontend.users.edit');
        }
        return View::make('frontend.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
       
        $input = array(
            'password' => Input::get('password'),
            'password_confirmation' => Input::get('password_confirmation'),
            'name' => Input::get('name'),
            'address' => Input::get('address'),
            'phone' => Input::get('phone'),
            'is_admin' => Input::get('is_admin'),
        );
        $rule = array(
            'password' => 'min:4|confirmed',
            'password_confirmation' => 'min:4',
            'name' => 'required',
            'address' => 'required'
        );
        $validator = \Validator::make($input, $rule);
        if ($validator->fails()) {
            return Redirect::route('admin.edit', $id)
                            ->withInput()
                            ->withErrors($validator)
                            ->with('message', 'There were validation errors.');
        } else {
            $user = User::find($id);

            $name = Input::get('name');
            $address = Input::get('address');
            $phone = Input::get('phone');
            $is_admin = Input::get('is_admin');

            $user->name = $name;
            $user->address = $address;
            $user->phone = $phone;
            $user->is_admin = $is_admin;

            $user->save();
            return Redirect::route('admin.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
        User::find($id)->delete();
        return Redirect::route('admin.index');
    }

    

    public function getViewDetails() {
        if (UsersHelper::checkLogged()) {
            $data['albums'] = Album::where('user_id', Session::get('current_user'))->get();
            $info = User::find(Session::get('current_user'));
            return View::make('frontend/users/details')->with('data', $data)->with('info', $info);
        } else {
            return Redirect::to('home/index');
        }
    }

//Edit từ trang details 
    public function getEdit($id) {
        $user = User::find(Session::get('current_user'));
        return View::make('frontend/users/edit')->with('user', $user);
    }

    public function DetailsUpdate($id) {
        $input = array(
            'name' => Input::get('name'),
            'address' => Input::get('address'),
            'phone' => Input::get('phone'),
        );
        $rule = array(
            'name' => 'required',
            'address' => 'required'
        );
        $validator = \Validator::make($input, $rule);
        if ($validator->fails()) {
            return Redirect::to('user/edit/' . $id)
                            ->withInput()
                            ->withErrors($validator)
                            ->with('message', 'There were validation errors.');
        } else {
            $user = User::find($id);

            $name = Input::get('name');
            $address = Input::get('address');
            $phone = Input::get('phone');

            $user->name = $name;
            $user->address = $address;
            $user->phone = $phone;

            $user->save();
        }
    }

    public function postAjaxComment() {
        
    }

    public function postAjaxFollow() {
        if (!empty(Input::get('user_id')) && !empty(Input::get('current_user'))) {
            if (true) {
                $relation = new Relation;
                $relation->user1_id = Input::get('current_user');
                $relation->user2_id = Input::get('user_id');
                $relation->type = 1;
                $relation->save();
                echo 'true';
            }
        } else {
            echo 'false';
        }
    }

    public function postAjaxUnfollow() {
        if (!empty(Input::get('user_id')) && !empty(Input::get('current_user'))) {
            if (true) {
                $relation = Relation::where('user1_id', '=', Input::get('current_user'))->where('user2_id', '=', Input::get('user_id'))->get()->first();
                if ($relation->delete() == 1)
                    echo 'true';
            }
        }else {
            echo 'false';
        }
    }

    public function getLogin() {

        if (Session::get('current_user')) {
            return View::make('frontend/index');
        }
        return View::make('frontend/users/login');
    }

    public function getUpload() {
        if (UsersHelper::checkLogged()) {
            return View::make('frontend/users/upload');
        } else {
            return Redirect::to('home/index');
        }
    }

    public function getViewImages() {
        if (UsersHelper::checkLogged()) {
            $data['albums'] = Album::where('user_id', Session::get('current_user'))->get();
            return View::make('frontend/users/view-images')->with('data', $data);
        } else {
            return Redirect::to('home/index');
        }
    }

//    public function getSignup() {
//
//        if (Session::get('current_user')) {
//            return View::make('frontend/index');
//        }
//        return View::make('frontend/users/signup');
//    }

//    public function postSignup() {
//        if ($this->validateSignUpInfo()) {
//            Session::flash('signup_status', false);
//            return Redirect::to('user/signup');
//        } else {
//            if(!$this->isExistedUser()){
//                if($this->saveNewUser()){
//                    return Redirect::to('home');
//                }else{
//                    return Redirect::to('user/signup');
//                }
//            }else{
//                return Redirect::to('user/signup');
//            }
//        }
//    }
//    
    
    
    private function validateSignUpInfo(){
        $data = Input::all();
        $validator = Validator::make(
                array(
                    'password' => $data['password'],
                    'password_confirm' => $data['password_confirm'],
                    'account' => $data['account'],
                    'name' => $data['name'],
                    'address' => $data['address'],
                    'phone' => $data['phone'],
                    'email' => $data['email'],
                    'is_admin' => 0
                        ), 
                array(
                    'name' => 'required|min:6',
                    'account' => 'required|min:6',
                    'password' => 'required|min:6',
                    'password_confirm' => 'same:password',
                    'email' => 'email|required',
                    'phone' => 'numeric',
                    )
        );
        if($validator->fails()){
            Session::flash('signup_status', false);
            Session::flash('errors_message',$validator->messages());
        }
    }

    
    
   
//    public function postAjaxSignup() {
//        $data = Input::all();
//        $validator = Validator::make(
//                        array(
//                    'password' => $data['password'],
//                    'password_confirm' => $data['password_confirm'],
//                    'account' => $data['account'],
//                    'name' => $data['name'],
//                    'address' => $data['address'],
//                    'phone' => $data['phone'],
//                    'email' => $data['email'],
//                    'is_admin' => 0
//                        ), array(
//                    'name' => 'required|min:5',
//                    'account' => 'required|min:5',
//                    'password' => 'required|min:5',
//                    'password_confirm' => 'same:password',
//                    'email' => 'email|required|min:5',
//                    'phone' => 'numeric|required',
//                    'address' => 'required',
//                        )
//                        // array(
//                        // 	'required' => 'Yêu cầu bắt buộc.',
//                        // 	//'min:5' => 'Tối thiểu 5 ký tự',
//                        // 	)
//        );
//        if ($validator->fails()) {
//            $messages = $validator->messages();
//            // $messages
//            echo 'not valid info';
//        } else {
//            $user = User::where('account', $data['account'])->first();
//            if ($user) {
//                echo 'fail';
//            } else {
//                $new = new User;
//                $new->name = $data['name'];
//                $new->account = $data['account'];
//                $new->password = $data['password'];
//                $new->email = $data['email'];
//                $new->phone = $data['phone'];
//                $new->address = $data['address'];
//                $new->save();
//                Session::put('current_user', $new->toArray());
//                echo 'success';
//            }
//        }
//    }

    

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        if (UsersHelper::checkIsAdmin()) {
            $users = User::all();
            return View::make('backend.users.list')->with('users', $users);
        } else {
            return Redirect::to('home/index');
        }
    }

    
}
