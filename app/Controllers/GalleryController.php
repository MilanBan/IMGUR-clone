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
        $gallery = $this->galleryM->find(['slug', $slug]) ?? null;

        $images = $this->imagesM->getAllFromGallery($gallery->id);

        return $this->renderView('gallery/show', ['gallery' => $gallery, 'images' => $images]);
    }

    public function edit($slug)
    {
        var_dump('usao u edit');
        $gallery = $this->galleryM->find(['slug', $slug]);

        return $this->renderView('gallery/edit', ['gallery' => $gallery]);
    }

    public function update($id)
    {
        var_dump('usao u update');

        $gallery = $this->galleryM->find(['id', $id]);

        $this->galleryM->name = trim($_POST['name']);;
        $this->galleryM->description = trim($_POST['description']);;
        $this->galleryM->hidden = (isset($_POST['hidden']) == '1' ? '1' : '0');;
        $this->galleryM->nsfw = (isset($_POST['nsfw']) == '1' ? '1' : '0');

        $this->galleryM->update($id);

        return $this->redirect('galleries/'. $gallery->slug);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');

        $gallery = $this->galleryM->find(['id', $id]);
        if (!$gallery)
        {
            echo json_encode(['error' => 'Gallery not exists']);

            http_response_code(404);

        }
        $this->galleryM->delete($id);
        http_response_code(200);


    }
}