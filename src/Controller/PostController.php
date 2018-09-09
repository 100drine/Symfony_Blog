<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Comments;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
Use Symfony\Component\Form\Extension\Core\Type\TextType;
Use Symfony\Component\Form\Extension\Core\Type\TextareaType;
Use Symfony\Component\Form\Extension\Core\Type\SubmitType;
Use Symfony\Component\Form\Extension\Core\Type\DateType;


class PostController extends AbstractController
{
    /**
     * @Route("/", name="post_list")
     * @Method({"GET"})
     */
    public function index()
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/post/new", name="new_post")
     * @Method({"GET","POST"})
     */
    public function new(Request $request){
        $post=new Post();
        $post->setCreatedAt(new \DateTime('now'));

        $form = $this -> createFormBuilder($post)
            ->add('title',TextType::class, array('attr'=>array('class'=>'form-control')))
            ->add('author',TextType::class, array('attr'=>array('class'=>'form-control')))
            ->add('content',TextareaType::class, array('attr'=>array('class'=>'form-control')))
            ->add('save',SubmitType::class, array('label' => 'Create', 'attr'=>array('class'=>'btn btn-primary mt-3')))
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $post = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('post_list');
        }
        return $this->render('post/new.html.twig',array('form'=>$form->createView()));
    }

    /**
     * @Route("/post/{id}", name ="post_show", requirements={"id"="\d+"})
     */ 
    public function show($id,Request $request){
        $post = $this->getDoctrine()->getRepository(Post::class)->find($id);
        $comments = $this->getDoctrine()->getRepository(Comments::class)->findByPost($id);
        $comment=new Comments();
        $comment->setPost($post);
        $comment->setCreatedAt(new \DateTime('now'));
        $form = $this->createFormBuilder($comment)
            ->add('author',TextType::class, array('attr'=>array('class'=>'form-control')))
            ->add('content',TextareaType::class, array('attr'=>array('class'=>'form-control')))
            ->add('save',SubmitType::class, array('label' => 'Comment', 'attr'=>array('class'=>'btn btn-primary mt-3')))
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $comment = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('post_show', array('id' => $id));
        }
        return $this->render('post/show.html.twig',array('post'=> $post, 'comments' => $comments, 'form'=>$form->createView()));
    }
    
    /**
     * @Route("/post/edit/{id}", name="post_edit", requirements={"id"="\d+"})
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request , $id){
        $post=new Post();
        $post = $this->getDoctrine()->getRepository(Post::class)->find($id);
        $post->setUpdatedAt(new \DateTime('now'));

        $form = $this -> createFormBuilder($post)
            ->add('title',TextType::class, array('attr'=>array('class'=>'form-control')))
            ->add('author',TextType::class, array('attr'=>array('class'=>'form-control')))
            ->add('content',TextareaType::class, array('attr'=>array('class'=>'form-control')))
            ->add('save',SubmitType::class, array('label' => 'Edit', 'attr'=>array('class'=>'btn btn-primary mt-3')))
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('post_list');
        }
            return $this->render('post/edit.html.twig',array('form'=> $form->createView()));
    }
    /**
     * @Route("/post/delete/{id}", name="post_delete", requirements={"id"="\d+"})
     * @Method({"DELETE"})
     */
    public function delete(Request $request , $id){
        $post = $this->getDoctrine()->getRepository(Post::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($post);
        $entityManager->flush();
        
        return $this->redirectToRoute('post_list');
    }

        /**
     * @Route("/post/{post_id}/delete/{id}", name="post_delete", requirements={"id"="\d+"})
     * @Method({"DELETE"})
     */
    public function deleteComment(Request $request , $id, $post_id){
        $comment = $this->getDoctrine()->getRepository(Comments::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($comment);
        $entityManager->flush();
        
        return $this->redirectToRoute('post_show', array('id' => $post_id));
    }
}
