<?php

namespace App\Controllers;

use App\Helper;
use App\Models\CommentModel;
use App\Models\ImageModel;
use Core\Session;

class ImageController extends Controller
{
    private ImageModel $imageM;
    private CommentModel $commentM;

    public function __construct()
    {
        parent::__construct();
        $this->imageM = new ImageModel();
        $this->commentM = new CommentModel();
    }

    public function show($slug)
    {
        var_dump('usao u show image');
        $image = $this->imageM->findImage(['slug', $slug]);

        $comments = $this->commentM->getAll('image', $image->id);

        $this->renderView('image/show', ['image' => $image, 'comments' => $comments]);
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
                $this->imageM->hidden = (isset($_POST['hidden']) == '1' ? '1' : '0');;
                $this->imageM->nsfw = (isset($_POST['nsfw']) == '1' ? '1' : '0');


                $gallery_id = $_POST["gallery_id"];

                $this->imageM->insert($gallery_id);
                $this->redirect('/profile/' . Session::get('username'));
            }
        }
    }

    public function edit($slug)
    {
        $image = $this->imageM->findImage(['slug', $slug]);

        return $this->renderView('image/edit', ['image' => $image]);
    }

    public function update($id)
    {
        $image = $this->imageM->findImage(['id', $id]);

        if (Session::get('user')->id == $image->user_id || in_array(Session::get('user')->role, ['admin', 'moderator'])) {
            $this->imageM->slug = trim($_POST['slug']);;
            $this->imageM->hidden = (isset($_POST['hidden']) == '1' ? '1' : '0');;
            $this->imageM->nsfw = (isset($_POST['nsfw']) == '1' ? '1' : '0');

            $this->imageM->update($id);

            return $this->redirect('/profile/'.Session::get('username'));

        }else {
            $this->renderView('__403'); //TODO: forbidden view
        }
    }

    public function delete($id)
    {

        header('Content-Type: application/json');

        $image = $this->imageM->findImage(['id', $id]);


        if (!$image)
        {
            echo json_encode(['error' => 'Image not exists']);

            http_response_code(404);
        }

        $this->imageM->delete($id);
        http_response_code(200);


    }
}