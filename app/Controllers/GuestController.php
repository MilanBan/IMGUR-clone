<?php

namespace App\Controllers;

use App\Models\GalleryModel;
use App\Models\ImageModel;
use App\Models\UserModel;
use Core\Session;

class GuestController extends Controller
{
    private ImageModel $imageM;
    private GalleryModel $galleryM;
    private UserModel $userM;

    public function __construct()
    {
        parent::__construct();
        $this->imageM = new ImageModel();
        $this->galleryM = new GalleryModel();
        $this->userM = new UserModel();
    }

    public function index()
    {
        var_dump('usao u index guest-ctrl');

        $images = $this->imageM->getAll();

        $this->renderView('Home', ['images' => $images]);
    }

    public function galleries()
    {
        if (!Session::get('user')){
            $this->redirect('');
        }

        $galleries = $this->galleryM->getAllFromUser(0);
        $cover = [];

        foreach ($galleries as $gallery){
            $cover[$gallery->id] = $this->imageM->getCover($gallery->id);

        }
        $this->renderView('Home', ['galleries' => $galleries, 'cover' => $cover]);
    }

    public function profiles()
    {
        if (!Session::get('user')){
            $this->redirect('');
        }
        $users = $this->userM->getAll();

        $this->renderView('Home', ['users' => $users]);
    }


}