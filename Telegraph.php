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
        $info = array(
            "text" => $this->text,
            "title" => $this->title,
            "author" => $this->author,
            "published " => $this->published,
        );
        $about = serialize($info);
        $current = file_get_contents($this->slug);
        $current .= "$about\n";
        file_put_contents($this->slug, $current);
    }

    function loadText(): string
    {
        if (file_exists($this->slug)) {

            $info = unserialize(file_get_contents($this->slug));

            $this->title = $info['title'];

            $this->text = $info['text'];

            $this->author = $info['author'];

            $this->published = $info['published'];

        }

        return $this->text;
    }

    function editText($title, $text)
    {
        $this->title = $title;
        $this->text = $text;
    }


}

$telText = new TelegraphText("Vlad", "Text.txt");
$telText->editText("Vlaaad", "Nme schimbat");
$telText->storeText();
$telText->loadText();

