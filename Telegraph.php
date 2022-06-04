<?php

class TelegraphText
{
    public string $text;
    public string $title;
    public string $author;
    public string $published;
    public string $slug;

    public function __construct($author, $slug)
    {
        $this->author = $author;
        $this->slug = $slug;
        $this->published = date("Y:M:D");
    }

    function storeText()
    {
        $inf = array(
            "text" => $this->text,
            "title" => $this->title,
            "author" => $this->author,
            "published " => $this->published,
        );
        $inf_serialized = serialize($inf);
        $op = file_get_contents($this->slug);
        $op .= $inf_serialized;
        file_put_contents($this->slug,$op);
    }

    function loadText(): string
    {
        $slug = $this->slug;
        $inf_unserialized = unserialize($slug);
        $this->text = $inf_unserialized["text"];
        $this->title = $inf_unserialized["title"];
        $this->author = $inf_unserialized["author"];
        $this->published = $inf_unserialized["published"];
        return $this->text;
    }

    function editText($title,$text)
    {
        $this->title = $title;
        $this->text = $text;
    }



}

$telText = new TelegraphText("Vlad", "Text.txt");
$telText->editText("Vlaaad", "Nme schimbat");
$telText->storeText();
$telText->loadText();

