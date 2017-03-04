<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\GenusFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Genus;

class GenusAdminController extends Controller
{
	/**
	 * @Route("/admin/genus/list", name="admin_genus_list")
	 */
	public function showAction()
	{
		$em = $this->getDoctrine()->getManager();
		$genuses = $em->getRepository('AppBundle:Genus')->findAll();
		
		return $this->render('genus/list.html.twig', array(
			'genuses' => $genuses
		));
	}
	
	/**
	 * @Route("/admin/genus", name="admin_genus")
	 */
	public function newAction(Request $request)
	{
		$form = $this->createForm(GenusFormType::class);
		
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$genus = $form->getData();
			
			$em = $this->getDoctrine()->getManager();
			$em->persist($genus);
			$em->flush();
			
			$this->addFlash('success', 'Genus created!');
			return $this->redirectToRoute('admin_genus_list');
		}
		
		return $this->render('admin/genus/new.html.twig', [
			'genusForm' => $form->createView(),
		]);
	}
	
	/**
	 * @Route("/admin/genus/{id}/edit", name="admin_genus_edit")
	 */
	public function editAction(Request $request, Genus $genus)
	{
	    $form = $this->createForm(GenusFormType::class, $genus);
	
	    $form->handleRequest($request);
	    if ($form->isSubmitted() && $form->isValid()) {
	        $genus = $form->getData();
	        	
	        $em = $this->getDoctrine()->getManager();
	        $em->persist($genus);
	        $em->flush();
	        	
	        $this->addFlash('success', 'Genus updated!');
	        return $this->redirectToRoute('admin_genus_list');
	    }
	
	    return $this->render('admin/genus/edit.html.twig', [
	            'genusForm' => $form->createView(),
	    ]);
	}
}