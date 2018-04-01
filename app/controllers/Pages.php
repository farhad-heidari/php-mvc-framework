<?php
  class Pages extends Controller {
      public function __construct(){
        //echo 'Pages loaded';
        // $this->postModel = $this->model('Post'); //model->post
      }

      public function index(){
        // $posts = $this->postModel->getPosts(); //model->post
        $data = [
          'title' => 'Welcome',
          // 'posts' => $posts //model->post
      ];

        $this->view('pages/index', $data); 
      }

      public function about(){
        $data = [
          'title' => 'About Us'
      ];
        $this->view('pages/about', $data);         
      }
  }