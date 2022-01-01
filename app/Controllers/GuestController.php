<?php

namespace App\Controllers;

use App\Models\ImageModel;
use Core\Session;

class GuestController extends Controller
{
    public ImageModel $imageM;

    public function __construct()
    {
        parent::__construct();
        $this->imageM = new ImageModel();
    }

    public function index()
    {
//        Session::start();

        if (Session::get('user')) {
            $this->redirect('profile/'. Session::get('user')->id);
        }else {
            $images = $this->imageM->guest_getAll();
            $this->renderView('Home', ['images' => $images]);
        }
    }

    public function show($slug)
    {
        $image = $this->imageM->guest_find(['slug', $slug]);

        if ($image){
            return $this->renderView('Home',['image' => $image]);
        }
    }


}