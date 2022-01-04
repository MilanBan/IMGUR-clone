<?php

namespace App\Controllers;

use App\Helper;
use App\Models\GalleryModel;
use App\Models\ImageModel;
use Core\Session;

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

    public function create()
    {
        if (Session::get('user')){
            return $this->renderView('gallery/create');
        }else{
            return $this->redirect('');
        }
    }

    public function store()
    {
        if (strtolower($_SERVER["REQUEST_METHOD"]) === "post") {
            if (isset($_POST['name']) && isset($_POST['description'])) {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


                    $this->galleryM->name = trim($_POST["name"]);
                    $this->galleryM->description = trim($_POST["description"]);
                    $this->galleryM->user_id = Session::get('user')->id;
                    $this->galleryM->slug = Helper::slugify(trim($_POST["name"]).'-'.time());

                $errors = $this->galleryM->validate();

                if (count($errors)){
                    http_response_code(422);
                    $this->renderView('gallery/create', ['errors' => $errors, 'gallery' => $this->galleryM]);
                }else{
                    $this->galleryM->insert();
                    $this->redirect('profile/'.Session::get('username'));
                }
            }
        }
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