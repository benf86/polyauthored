<?php

namespace AppBundle\Controller\World;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\World\WorldEntity;
use AppBundle\Form\World\WorldEntityType;

/**
 * World\WorldEntity controller.
 *
 * @Route("/world_entity")
 */
class WorldEntityController extends Controller
{

    /**
     * Lists all World\WorldEntity entities.
     *
     * @Route("/", name="world_entity")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:World\WorldEntity')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new World\WorldEntity entity.
     *
     * @Route("/", name="world_entity_create")
     * @Method("POST")
     * @Template("AppBundle:World\WorldEntity:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new WorldEntity();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('world_entity_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a World\WorldEntity entity.
     *
     * @param WorldEntity $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(WorldEntity $entity)
    {
        $form = $this->createForm(new WorldEntityType(), $entity, array(
            'action' => $this->generateUrl('world_entity_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new World\WorldEntity entity.
     *
     * @Route("/new", name="world_entity_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new WorldEntity();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a World\WorldEntity entity.
     *
     * @Route("/{id}", name="world_entity_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:World\WorldEntity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find World\WorldEntity entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing World\WorldEntity entity.
     *
     * @Route("/{id}/edit", name="world_entity_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:World\WorldEntity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find World\WorldEntity entity.');
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
    * Creates a form to edit a World\WorldEntity entity.
    *
    * @param WorldEntity $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(WorldEntity $entity)
    {
        $form = $this->createForm(new WorldEntityType(), $entity, array(
            'action' => $this->generateUrl('world_entity_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing World\WorldEntity entity.
     *
     * @Route("/{id}", name="world_entity_update")
     * @Method("PUT")
     * @Template("AppBundle:World\WorldEntity:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:World\WorldEntity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find World\WorldEntity entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('world_entity_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a World\WorldEntity entity.
     *
     * @Route("/{id}", name="world_entity_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:World\WorldEntity')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find World\WorldEntity entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('world_entity'));
    }

    /**
     * Creates a form to delete a World\WorldEntity entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('world_entity_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
