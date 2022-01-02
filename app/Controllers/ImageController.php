<?php

namespace App\Controllers;

use App\Models\ImageModel;

class ImageController extends Controller
{
    private ImageModel $imageM;

    public function __construct()
    {
        parent::__construct();
        $this->imageM = new ImageModel();
    }

    public function show($slug)
    {
        $image = $this->imageM->findImage(['slug', $slug]);

        $this->renderView('Image', ['image' => $image]);
    }
}