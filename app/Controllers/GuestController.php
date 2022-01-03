<?php

namespace App\Controllers;

use App\Models\ImageModel;
use Core\Session;
use mysql_xdevapi\Exception;

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
        var_dump('usao u index guest-ctrl');

        $images = $this->imageM->getAll();

        $this->renderView('Home', ['images' => $images]);
    }

    public function show($slug)
    {
        var_dump('usao u show guest-ctrl');
        $image = $this->imageM->guest_find(['slug', $slug]);
        if ($image) {
            return $this->renderView('Home', ['image' => $image]);
        }
    }


}