<?php

namespace App\Controllers;

use App\Models\UserModel;
use Core\Session;

class UserController extends Controller
{
    private UserModel $userM;

    public function __construct()
    {
        parent::__construct();
        $this->userM = new UserModel();
    }

    public function edit($id)
    {
        $user = $this->userM->find('user', ['id', $id]);

        if (Session::get('user')->id !== $user->id && Session::get('user')->roll !== 'admin'){
            $this->redirect('');
        }

        return $this->renderView('profile/administration', ['user' => $user]);
    }

    public function update($id)
    {
        $user = $this->userM->find('user', ['id', $id]);

        if (Session::get('user')->id == $user->id || Session::get('user')->roll == 'admin'){
            $this->userM->role = $_POST['role'];

            $this->userM->update($id);
            if (Session::get('user')->id == $user->id)
            {
                $user->role = $_POST['role'];
                Session::set('user', $user);

            }
            return $this->redirect('profile/'.Session::get('username'));

        }else {
            $this->renderView('__403'); //TODO: forbidden view
        }
    }
}