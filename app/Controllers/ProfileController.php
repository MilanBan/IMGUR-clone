<?php

namespace App\Controllers;

use App\Models\ImageModel;
use App\Models\UserModel;
use Core\Session;

class ProfileController extends Controller
{
    private UserModel $userM;
    private ImageModel $imageM;

    public function __construct()
    {
        parent::__construct();
        $this->userM = new UserModel();
        $this->imageM = new ImageModel();
    }

    public function index($id)
    {
        var_dump('usao u index p-ctrl');
        if ($id)
        {
            $user = $this->userM->find('user', ['id', $id]);
            $images= $this->imageM->getAll($id) ?? null;

        }else{
            echo ' nije poslat id u profile crtl';
        }

        return $this->renderView('Profile', ['user' => $user, 'images' => $images]);
    }

    public function show($slug)
    {

        var_dump("usao u show p-crtl");
        $image = $this->imageM->find(['slug', $slug]);

        if (!$image){
            echo 'nema slike';
        }
        return $this->renderView('Profile',['image' => $image]);
    }
}