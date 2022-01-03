<?php

namespace App\Controllers;

use App\Models\GalleryModel;
use App\Models\UserModel;
use Core\Session;

class ProfileController extends Controller
{
    private UserModel $userM;
    private GalleryModel $galleryM;

    public function __construct()
    {
        parent::__construct();
        $this->userM = new UserModel();
        $this->galleryM = new GalleryModel();
    }

    public function index($username)
    {
        var_dump('usao u index p-ctrl: '.$username);

        $user = $this->userM->find('user', ['username', Session::get('user')->username]);
        $galleries = $this->galleryM->getAllFromUser($user->id) ?? null;

        return $this->renderView('profile/show', ['user' => $user, 'galleries' => $galleries]);
    }

}