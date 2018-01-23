<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Weapon;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Weapon controller.
 *
 * @Route("weapon")
 */
class WeaponController extends Controller
{
    /**
     * Lists all weapon entities.
     *
     * @Route("/", name="weapon_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $weapons = $em->getRepository('AppBundle:Weapon')->findAll();

        return $this->render('weapon/index.html.twig', array(
            'weapons' => $weapons,
        ));
    }

    /**
     * Creates a new weapon entity.
     *
     * @Route("/new", name="weapon_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $weapon = new Weapon();
        $form = $this->createForm('AppBundle\Form\WeaponType', $weapon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($weapon);
            $em->flush();

            return $this->redirectToRoute('weapon_show', array('id' => $weapon->getId()));
        }

        return $this->render('weapon/new.html.twig', array(
            'weapon' => $weapon,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a weapon entity.
     *
     * @Route("/{id}", name="weapon_show")
     * @Method("GET")
     */
    public function showAction(Weapon $weapon)
    {
        $deleteForm = $this->createDeleteForm($weapon);

        return $this->render('weapon/show.html.twig', array(
            'weapon' => $weapon,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing weapon entity.
     *
     * @Route("/{id}/edit", name="weapon_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Weapon $weapon)
    {
        $deleteForm = $this->createDeleteForm($weapon);
        $editForm = $this->createForm('AppBundle\Form\WeaponType', $weapon);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('weapon_edit', array('id' => $weapon->getId()));
        }

        return $this->render('weapon/edit.html.twig', array(
            'weapon' => $weapon,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a weapon entity.
     *
     * @Route("/{id}", name="weapon_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Weapon $weapon)
    {
        $form = $this->createDeleteForm($weapon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($weapon);
            $em->flush();
        }

        return $this->redirectToRoute('weapon_index');
    }

    /**
     * Creates a form to delete a weapon entity.
     *
     * @param Weapon $weapon The weapon entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Weapon $weapon)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('weapon_delete', array('id' => $weapon->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
