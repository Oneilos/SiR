<?php

namespace LinkR\Bundle\CommentBundle\Controller;

use LinkR\Bundle\CommentBundle\Model\Comment;

use LinkR\Bundle\TaskBundle\Model\TaskQuery;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * controller for comments use cases
 */
class CommentController extends Controller
{
    /**
     * displays comment form and handle it on post
     * @param  Request  $request
     * @return Response
     */
    public function formAction(Request $request)
    {
        $task = TaskQuery::create()
            ->setComment(sprintf('%s l:%s', __METHOD__, __LINE__))
            ->findPk($request->attributes->get('task_id'));

        if (!$task) {
            throw new NotFoundHttpException('Task not found for given id : '.$request->attributes->get('task_id'));
        }

        $comment = new Comment();
        $form    = $this->container->get('form.factory')->create('comment_form', $comment, array(
            'task_id' => $task->getId()
        ));

        if ($request->request->has($form->getName())) {
            $flashbag = $this->container->get('session')->getFlashbag();
            $handler  = $this->container->get('LinkR.comment.form_handler');

            if ($handler->handle($form, $request)) {
                return $this->render('LinkRCommentBundle:Comment:element.html.twig', array(
                    'comment' => $form->getData()
                ));
            }

            $flashbag->add('error', $handler->error);
        }

        return $this->render('LinkRCommentBundle:Comment:form.html.twig', array(
            'form' => $form->createView(),
            'task' => $task
        ));
    }
}
