<?php

namespace AppBundle\Controller\Story;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Story\Post;
use AppBundle\Form\Story\PostType;
use AppBundle\Entity\Story\Story;
use AppBundle\Entity\World\World;

/**
 * Story\Post controller.
 *
 * @Route("/post")
 */
class PostController extends Controller
{
    /**
     * Lists all Story\Post entities.
     *
     * @Route("/", name="post")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Story\Post')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Story\Post entity.
     *
     * @Route("/", name="post_create")
     * @Method("POST")
     * @Template("AppBundle:Story\Post:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Post();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity->setOwner($this->container->get('security.context')->getToken()->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('post_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Story\Post entity.
     *
     * @param Post $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Post $entity)
    {
        $form = $this->createForm(new PostType(), $entity, array(
            'action' => $this->generateUrl('post_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Story\Post entity.
     *
     * @Route("/new/{story}/{world}", defaults={"story" = "new", "world" = "new"}, name="post_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($story, $world)
    {
        /**
         * Create new Story and/or world if new
         */
        $user = $this->container->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        if ($world != 'new' && $em->getRepository('AppBundle:World\World')->find($world)) 
        {
            $world = $em->getRepository('AppBundle:World\World')->find($world);
        } else { 
            $world = new World($user);
            $world->setName($user->getName() . '\'s World ' . rand());
            $world->setPublished(false);
            $em->persist($world);
            $em->flush();
        }

        if ($story != 'new' && $em->getRepository('AppBundle:Story\Story')->find($story))
        {
            $story = $em->getRepository('AppBundle:Story\Story')->find($story);
        } else {
            $story = new Story($user, $world);
            $story->setTitle($user->getName() . '\'s Story ' . rand());
            $story->setPublished(false);
            $story->setWorld($world);
            $em->persist($story);
            $em->flush();
        }
        
        $entity = new Post();
        $entity->setStory($story);
        $entity->setPublished(false);
        $entity->setContent('');
        $entity->setSynopsis('');
        $entity->setTitle('');
        $entity->setOwner($user);
        $em->persist($entity);
        $em->flush();
        $form   = $this->createEditForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Story\Post entity.
     *
     * @Route("/{id}", name="post_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Story\Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Story\Post entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Story\Post entity.
     *
     * @Route("/{id}/edit", name="post_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Story\Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Story\Post entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Story\Post entity.
    *
    * @param Post $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Post $entity)
    {
        $form = $this->createForm(new PostType(), $entity, array(
            'action' => $this->generateUrl('post_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Story\Post entity.
     *
     * @Route("/{id}", name="post_update")
     * @Method("PUT")
     * @Template("AppBundle:Story\Post:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Story\Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Story\Post entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('post_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Story\Post entity.
     *
     * @Route("/{id}", name="post_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Story\Post')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Story\Post entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('post'));
    }

    /**
     * Creates a form to delete a Story\Post entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('post_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
