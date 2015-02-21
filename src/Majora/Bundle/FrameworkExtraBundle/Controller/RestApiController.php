<?php

namespace Majora\Bundle\FrameworkExtraBundle\Controller;

use JMS\Serializer\SerializationContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Base class for REST APIs entity controllers
 *
 * @package majora-framework-extra-bundle
 * @subpackage controller
 */
class RestApiController extends Controller
{
    /**
     * Parse filter string list to array
     *
     * @param  string $list
     * @return array
     */
    protected function parseFilter($list)
    {
        return array_filter(explode(',', trim($list, ',')), function ($var) {
            return !empty($var);
        });
    }

    /**
     * Retrieves entity for given id into given repository service
     *
     * @param $entityId
     * @param $loaderId
     * @return Object
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    protected function retrieveOr404($entityId, $loaderId)
    {
        if (!$this->container->has($loaderId)) {
            throw new NotFoundHttpException(sprintf('Unknow required loader : "%s"',
                $loaderId
            ));
        }

        // @todo introduce proper method
        if (!$entity = $this->get($loaderId)->retrieve($entityId)) {
            throw $this->createRest404($entityId, $loaderId);
        }

        return $entity;
    }

    /**
     * create a formatted http not found exception
     *
     * @param  string                $entityId
     * @param  string                $loaderId
     * @return NotFoundHttpException
     */
    protected function createRest404($entityId, $loaderId)
    {
        return new NotFoundHttpException(sprintf('Entity with id "%s" not found%s.',
            $entityId,
            $this->get('service_container')->getParameter('kernel.debug') ?
                sprintf(' : (looked into "%s")', $loaderId) :
                ''
        ));
    }

    /**
     * Create a JsonResponse with given data, if object given, it will be serialize
     * with registered serializer
     *
     * @param  mixed    $data
     * @param  string   $scope
     * @param  int      $status
     *
     * @return Response
     */
    protected function createJsonResponse($data = null, $scope = null, $status = 200)
    {
        if ($data !== null) {
            $data = is_string($data) ?
                $data :
                $this->get('serializer')->serialize(
                    $data,
                    'json',
                    empty($scope) ? null : SerializationContext::create()->setGroups($scope)
                )
            ;
        }

        $response = new Response(null === $data ? '' : $data, $status);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @param  int          $status
     * @param  array        $headers
     * @return JsonResponse
     */
    protected function createJsonNoContentResponse()
    {
        $response = new Response(null, 204);
        $response->headers->set('Content-Type', null);

        return $response;
    }

    /**
     * create and returns a 400 Bad Request response
     *
     * @param  array        $errors
     * @param  array        $headers
     * @return JsonResponse
     */
    protected function createJsonBadRequestResponse(array $errors = array())
    {
        // try to extract proper validation errors
        foreach ($errors as $key => $error) {
            if (!$error instanceof FormError) {
                continue;
            }
            $errors['errors'][$key] = array(
                'message'    => $error->getMessage(),
                'parameters' => $error->getMessageParameters()
            );
            unset($errors[$key]);
        }

        $response = new Response(
            is_string($errors) ? $errors : json_encode($errors),
            400
        );

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Decode a json string and check for errors
     *
     * @param $json
     * @param $assoc
     * @param  int                     $depth
     * @param  int                     $options
     * @return mixed
     * @throws BadRequestHttpException
     */
    protected function json_clean_decode($json, $assoc = true, $depth = 512, $options = 0)
    {
        $arrayData = json_decode($json, $assoc, $depth, $options);

        if (null === $arrayData) {
            throw new BadRequestHttpException(
                sprintf('There is an error in your JSON data: %s-%s', json_last_error(), json_last_error_msg())
            );
        }

        return $arrayData;
    }

    /**
     * Custom method for form submission to handle http method bugs, and extra fields
     * error options
     *
     * @param Request       $request
     * @param FormInterface $form
     *
     * @return boolean
     */
    protected function submitJsonData(Request $request, FormInterface $form)
    {
        $data = $this->extractFormData(
            $this->get('lac.normalizer.camel_keys')->normalize(
                $this->json_clean_decode($request->getContent())
            ),
            $form
        );

        $form->submit($data);
        if (!$valid = $form->isValid()) {
            $this->get('logger')->notice(
                'Invalid form submitted',
                ['errors' => $form->getErrors(), 'data' => $data]
            );
        }

        return $valid;
    }

    /**
     * Removes additional data that hasn't been defined in the form
     *
     * @param  array         $data
     * @param  FormInterface $form
     * @return array
     */
    protected function extractFormData(array $data, FormInterface $form)
    {
        $return       = array();
        $formChildren = $form->all();

        foreach ($formChildren as $formKey => $formChild) {

            if (!isset($data[$formKey])) {
                continue;
            }

            if (!is_array($data[$formKey])) {
                $return[$formKey] = $data[$formKey];
                continue;
            }

            reset($data[$formKey]);
            if (is_string(key($data[$formKey]))) {
                $return[$formKey] = $this->extractFormData(
                    $data[$formKey],
                    $formChild
                );

                continue;
            }

            $formOptions = $formChild->getConfig()->getOptions();
            if (empty($formOptions['type'])) {
                $return[$formKey] = $data[$formKey];
                continue;
            }

            foreach ($data[$formKey] as $dataKey => $childData) {
                $return[$formKey][$dataKey] = $this->extractFormData(
                    $childData,
                    $this->createForm($formOptions['type'])
                );
            }
        }

        return $return;
    }
}
