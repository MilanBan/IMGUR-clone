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

    public function index($id)
    {
        var_dump('usao u index p-ctrl: '.$id);
        if ($id)
        {
            $user = $this->userM->find('user', ['id', $id]);
            $galleries = $this->galleryM->getAllFromUser($id) ?? null;
            var_dump($galleries);

        }else{
            echo ' nije poslat id u profile crtl';
        }

        return $this->renderView('Profile', ['user' => $user, 'galleries' => $galleries]);
    }

    public function show($slug)
    {

        var_dump("usao u show p-crtl");
        $image = $this->imageM->findFromUser(['slug', $slug]);

        if (!$image){
            echo 'nema slike';
        }

        return $this->renderView('Profile',['image' => $image]);
    }
}