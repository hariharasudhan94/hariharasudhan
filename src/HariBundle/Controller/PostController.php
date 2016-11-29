<?php

namespace HariBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use HariBundle\Entity\Post;
use HariBundle\Form\Type\PostType;
use Google_Client;
/**
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 */
class PostController extends Controller 
{
    /**
    * @Template("@Youtube/add/home.html.twig")
    */
    public function addAction(Request $request)
    {
       
       
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()):
            $this->get('hari.post_handler')->add($post);
        endif;
        
        return [
            'form' => $form->createView()
        ];
    }
}
