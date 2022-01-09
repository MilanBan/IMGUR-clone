<?php

namespace App\Controllers;

use App\Models\ModeratorLoggingModel;
use App\Models\UserModel;
use Core\Session;

class UserController extends Controller
{
    private UserModel $userM;
    private ModeratorLoggingModel $moderatorLogM;

    public function __construct()
    {
        parent::__construct();
        $this->userM = new UserModel();
        $this->moderatorLogM = new ModeratorLoggingModel();
    }

    public function edit($id)
    {
        $user = $this->userM->find('user', ['id', $id]);

        if (Session::get('user')->id !== $user->id && !in_array(Session::get('user')->role ,['admin', 'moderator'])){
            $this->redirect('');
        }

        return $this->renderView('profile/administration', ['user' => $user]);
    }

    public function update($id)
    {
        $user = $this->userM->find('user', ['id', $id]);
        if (in_array(Session::get('user')->role, ['moderator', 'admin'])){

            $this->userM->active = (isset($_POST['active']) == '1' ? '1' : '0');
            $this->userM->nsfw = (isset($_POST['nsfw']) == '1' ? '1' : '0');
            $this->userM->role = $user->role;

            if (Session::get('user')->role == 'admin'){
                $this->userM->role = $_POST['role'];
            }

            $this->userM->update($id);

            if (Session::get('user')->id == $user->id)
            {
                $user->role = $_POST['role'] ?? $user->role;
                Session::set('user', $user);
            }

            if (Session::get('user')->id !== $user->id && Session::get('user')->role == 'moderator')
            {
                if ($user->active !== $this->userM->active) {
                    $active = "active as ".$this->userM->active;
                }
                if ($user->nsfw !== $this->userM->nsfw){
                    $nsfw = "nsfw as ".$this->userM->nsfw;
                }
                $this->moderatorLogM->msg = "Moderator ". Session::get('user')->username ." set user ". $user->username ." ".$active." ".$nsfw ;
                $this->moderatorLogM->logging();
            }

            return $this->redirect('profile/'.Session::get('username'));

        }else {
            $this->renderView('__403'); //TODO: forbidden view
        }
    }
}