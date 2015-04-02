<?php

namespace AppBundle\Controller\World;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\World\World;
use AppBundle\Form\World\WorldType;

/**
 * World\World controller.
 *
 * @Route("/world")
 */
class WorldController extends Controller
{

    /**
     * Lists all World\World entities.
     *
     * @Route("/", name="world")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:World\World')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new World\World entity.
     *
     * @Route("/", name="world_create")
     * @Method("POST")
     * @Template("AppBundle:World\World:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new World();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('world_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a World\World entity.
     *
     * @param World $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(World $entity)
    {
        $form = $this->createForm(new WorldType(), $entity, array(
            'action' => $this->generateUrl('world_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new World\World entity.
     *
     * @Route("/new", name="world_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new World();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a World\World entity.
     *
     * @Route("/{id}", name="world_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:World\World')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find World\World entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing World\World entity.
     *
     * @Route("/{id}/edit", name="world_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:World\World')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find World\World entity.');
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
    * Creates a form to edit a World\World entity.
    *
    * @param World $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(World $entity)
    {
        $form = $this->createForm(new WorldType(), $entity, array(
            'action' => $this->generateUrl('world_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing World\World entity.
     *
     * @Route("/{id}", name="world_update")
     * @Method("PUT")
     * @Template("AppBundle:World\World:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:World\World')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find World\World entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('world_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a World\World entity.
     *
     * @Route("/{id}", name="world_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:World\World')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find World\World entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('world'));
    }

    /**
     * Creates a form to delete a World\World entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('world_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
