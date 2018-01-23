<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sailor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Sailor controller.
 *
 * @Route("sailor")
 */
class SailorController extends Controller
{
    /**
     * Lists all sailor entities.
     *
     * @Route("/", name="sailor_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sailors = $em->getRepository('AppBundle:Sailor')->findAll();

        return $this->render('sailor/index.html.twig', array(
            'sailors' => $sailors,
        ));
    }

    /**
     * Creates a new sailor entity.
     *
     * @Route("/new", name="sailor_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $sailor = new Sailor();
        $form = $this->createForm('AppBundle\Form\SailorType', $sailor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sailor);
            $em->flush();

            return $this->redirectToRoute('sailor_show', array('id' => $sailor->getId()));
        }

        return $this->render('sailor/new.html.twig', array(
            'sailor' => $sailor,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sailor entity.
     *
     * @Route("/{id}", name="sailor_show")
     * @Method("GET")
     */
    public function showAction(Sailor $sailor)
    {
        $deleteForm = $this->createDeleteForm($sailor);

        return $this->render('sailor/show.html.twig', array(
            'sailor' => $sailor,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sailor entity.
     *
     * @Route("/{id}/edit", name="sailor_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Sailor $sailor)
    {
        $deleteForm = $this->createDeleteForm($sailor);
        $editForm = $this->createForm('AppBundle\Form\SailorType', $sailor);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sailor_edit', array('id' => $sailor->getId()));
        }

        return $this->render('sailor/edit.html.twig', array(
            'sailor' => $sailor,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sailor entity.
     *
     * @Route("/{id}", name="sailor_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Sailor $sailor)
    {
        $form = $this->createDeleteForm($sailor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sailor);
            $em->flush();
        }

        return $this->redirectToRoute('sailor_index');
    }

    /**
     * Creates a form to delete a sailor entity.
     *
     * @param Sailor $sailor The sailor entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sailor $sailor)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sailor_delete', array('id' => $sailor->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
