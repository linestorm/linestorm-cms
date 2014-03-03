<?php

namespace LineStorm\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;

class AdminPostController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();
        if( !($user instanceof UserInterface) || !($user->hasGroup('admin')))
        {
            throw new AccessDeniedException();
        }

        $modelManager = $this->get('linestorm.blog.model_manager');

        $posts = $modelManager->get('post')->findAll();

        return $this->render('LineStormBlogBundle:Modules:Post/list.html.twig', array(
            'posts' => $posts,
        ));
    }


    public function editAction($id)
    {
        $user = $this->getUser();
        if( !($user instanceof UserInterface) || !($user->hasGroup('admin')))
        {
            throw new AccessDeniedException();
        }

        $modelManager = $this->get('linestorm.blog.model_manager');

        $post = $modelManager->get('post')->find($id);

        return $this->render('LineStormBlogBundle:Modules:Post/edit.html.twig', array(
            'post' => $post,
        ));
    }

}
