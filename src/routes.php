<?php

$this->router->get('/', function(\Blog\Blog\Index $index) {

    return view('index', array(
        'posts' => $index->getPosts()
    ));

});

$this->router->get('404', function() {
    return view('errors.not-found');
});

$this->router->get('500', function() {
    return view('errors.server-error');
});

$this->router->get('{slug}', function(\Blog\Blog\Index $index, \Blog\Blog\Post $post, $slug) {

    $posts = $index->getPosts();

    $info = $index->getPost($slug);

    $post->load($slug, $info);

    return view('post', array(
        'posts' => $posts,
        'post' => $post
    ));

});