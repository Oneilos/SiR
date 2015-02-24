<?php

namespace LinkR\Bundle\DocumentBundle\Controller;

use LinkR\Bundle\DocumentBundle\Model\Document;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

/**
 * controller for document displays
 */
class DocumentController extends Controller
{
    /**
     * action for single element displays
     * @param  Request  $request
     * @param  Document $document document to display
     * @param  array    $options  displaying options
     * @return Response
     */
    public function displayAction(Request $request, Document $document, array $options = array())
    {
        $form = $this->get('LinkR_document.form.upload');

        return $this->render('LinkRDocumentBundle:Document:display.html.twig', array(
            'document' => $document,
            'form'     => $form->createView(),
            'options'  => $options
        ));
    }
}
