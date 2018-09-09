<?php

namespace App\Controller;

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

class CommentsController extends AbstractController
{
    /**
     * @Route("/post/l/l/{id}", name="show_comments", requirements={"id" = "\d+"})
     */
/*     public function show($id){
        $comments = $this->getDoctrine()->getRepository(Comments::class)->findAll();

        $this->render('comments/index.html.twig',array('comments'=> $comments));
    } */

    /**
     * @Route("/post/{post_id}/delete/{id}", name="post_delete", requirements={"id"="\d+"})
     * @Method({"DELETE"})
     */
/*     public function deleteComment(Request $request , $id, $post_id){
        $comment = $this->getDoctrine()->getRepository(Comments::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($comment);
        $entityManager->flush();
        
        return $this->redirectToRoute('post_show', array('id' => $post_id));
    } */
}
