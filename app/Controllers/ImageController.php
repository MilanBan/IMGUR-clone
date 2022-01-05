<?php

namespace App\Controllers;

use App\Helper;
use App\Models\ImageModel;
use Core\Session;

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
        var_dump('usao u show image');
        $image = $this->imageM->findImage(['slug', $slug]);

        $this->renderView('image/show', ['image' => $image]);
    }

    public function create($id)
    {
        if (!Session::get('user')->id){
            $this->redirect('');
        }

        return $this->renderView('image/create', ['gallery_id' => $id]);
    }

    public function store()
    {
        var_dump('usao u stor');
        if (strtolower($_SERVER["REQUEST_METHOD"]) === "post") {
            if (isset($_POST['file_name']) && isset($_POST['gallery_id'])) {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $this->imageM->user_id = Session::get('user')->id;
                $this->imageM->file_name = trim($_POST["file_name"]);
                $this->imageM->slug = Helper::slugify(trim($_POST["name"]) . '-' . time());
                $gallery_id = $_POST["gallery_id"];

                $this->imageM->insert($gallery_id);
                $this->redirect('/profile/' . Session::get('username'));
            }
        }
    }
}