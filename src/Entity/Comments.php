<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentsRepository")
 */
class Comments
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Post")
     * @ORM\JoinColumn(nullable=false)
     */
    private $post;

    /**
     * @ORM\Column(type="text", length=100)
     */
    private $author;

    /**
     * @ORM\Column(type="text", length=500)
     */
    private $content;

        /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

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

    public function setPost($post){
        $this->post=$post;
    }

    public function getPost(){
        return $this->post;
    }
}