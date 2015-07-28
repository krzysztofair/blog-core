<?php

namespace Blog\Blog;

use Blog\Parsers\Markdown;
use Exception;

class Post
{
    public $title;

    public $image;

    public $intro;

    public $content;

    public $published;

    protected $markdown;

    public function __construct(Markdown $markdown)
    {
        $this->markdown = $markdown;
    }

    public function load($slug, $info)
    {
        if( ! is_readable(blog_path($slug.".md"))) throw new Exception(404);

        $contents = file_get_contents(blog_path($slug.".md"));

        $this->title = $info['title'];
        $this->published = $info['published'];
        $this->image = $info['image'];
        $this->intro = $info['intro'];

        $this->content = $this->markdown->parse($contents);
    }
}