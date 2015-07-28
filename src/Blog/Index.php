<?php

namespace Blog\Blog;

use Blog\Parsers\Yaml;
use Exception;

class Index
{
    protected $posts = array();

    public function __construct(Yaml $yaml)
    {
        if( ! is_readable(blog_path('blog.yaml'))) throw new Exception(500);

        $blog = $yaml->parse(file_get_contents(blog_path('blog.yaml')));

        $this->posts = (isset($blog['posts'])) ? $blog['posts'] : array();

        $this->addSlugs();

        $this->sortPosts();

        return $this->posts;
    }

    public function getPosts()
    {
        return $this->posts;
    }

    public function getPost($slug)
    {
        foreach($this->posts as $post)
        {
            if($post['slug'] == $slug) return $post;
        }

        throw new Exception(404);
    }

    private function addSlugs()
    {
        foreach($this->posts as $slug => $post)
        {
            $this->posts[$slug]['slug'] = $slug;
        }
    }

    private function sortPosts()
    {
        usort($this->posts, function($a, $b)
        {
            if ($a['published'] == $b['published']) {
                return 0;
            }

            return ($a['published'] < $b['published']) ? 1 : -1;
        });
    }
}