<?php

namespace App\Controllers;

use App\Models\GalleryModel;
use App\Models\ImageModel;

class GalleryController extends Controller
{
    private GalleryModel $galleryM;
    private ImageModel $imagesM;

    public function __construct()
    {
        parent::__construct();
        $this->galleryM = new GalleryModel();
        $this->imagesM = new ImageModel();
    }

    public function show($slug)
    {
        var_dump('usao u show g-ctrl: slug='.$slug);
        $gallery = $this->galleryM->findFromUser(['slug', $slug]) ?? null;
        $images = $this->imagesM->getAllFromGallery($gallery->id);

        return $this->renderView('gallery/show', ['gallery' => $gallery, 'images' => $images]);
    }
}