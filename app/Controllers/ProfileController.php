<?php

namespace App\Controllers;

use App\Models\ImageModel;
use App\Models\UserModel;

class ProfileController extends Controller
{
    private UserModel $userM;
    private ImageModel $imageM;

    public function __construct()
    {
        $this->userM = new UserModel();
        $this->imageM = new ImageModel();
    }

    public function index($id)
    {
        $user = $this->userM->find('user', ['id', $id]);
        $images= $this->imageM->getAll($id);

        return $this->renderView('Profile', ['user' => $user, 'images' => $images]);
    }
}