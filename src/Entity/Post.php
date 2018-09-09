<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="text", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="text", length=100)
     */
    private $author;

    /**
     * @ORM\Column(type="text", length=2000)
     */
    private $content;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", name="updated_at", nullable=false)
     */
    private $updatedAt;

    public function getTitle(){
        return $this->title;
    }
    public function setTitle($title){
        $this->title=$title;
    }

    public function getAuthor(){
        return $this->author;
    }
    public function setAuthor($author){
        $this->author=$author;
    }

    public function getContent(){
        return $this->content;
    }
    public function setContent($content){
        $this->content=$content;
    }

    public function getCreatedAt(){
        return $this->createdAt;
    }
    public function setCreatedAt($createdAt){
        $this->createdAt=$createdAt;
    }

    public function getUpdatedAt(){
        return $this->updatedAt;
    }
    public function setUpdatedAt($updatedAt){
        $this->updatedAt=$updatedAt;
    }
}
