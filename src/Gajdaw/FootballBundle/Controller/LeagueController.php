<?php

namespace Gajdaw\FootballBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Gajdaw\FootballBundle\Entity\League;
use Gajdaw\FootballBundle\Form\LeagueType;

/**
 * League controller.
 *
 * @Route("/league")
 */
class LeagueController extends Controller
{
    /**
     * Lists all League entities.
     *
     * @Route("/", name="league")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GajdawFootballBundle:League')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new League entity.
     *
     * @Route("/", name="league_create")
     * @Method("POST")
     * @Template("GajdawFootballBundle:League:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new League();
        $form = $this->createForm(new LeagueType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('league_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new League entity.
     *
     * @Route("/new", name="league_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new League();
        $form   = $this->createForm(new LeagueType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a League entity.
     *
     * @Route("/{id}", name="league_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawFootballBundle:League')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find League entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing League entity.
     *
     * @Route("/{id}/edit", name="league_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawFootballBundle:League')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find League entity.');
        }

        $editForm = $this->createForm(new LeagueType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing League entity.
     *
     * @Route("/{id}", name="league_update")
     * @Method("PUT")
     * @Template("GajdawFootballBundle:League:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawFootballBundle:League')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find League entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new LeagueType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('league_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a League entity.
     *
     * @Route("/{id}", name="league_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GajdawFootballBundle:League')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find League entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('league'));
    }

    /**
     * Creates a form to delete a League entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
