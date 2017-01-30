<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Genus;

class GenusController extends Controller
{
        
    /**
    * @Route("/genus/new")
    */
    public function newAction()
    {    
        $genus = new Genus();
        $genus->setName('Octopus'.rand(1, 100));
        $genus->setSubFamily('Octopodinae');
        $genus->setSpeciesCount(rand(100, 99999));
        
        $em    = $this->getDoctrine()->getManager();
        $em->persist($genus);
        $em->flush();
        
        return new Response('<html><body>Genus created!</body></html>');
    }
    
        
    /**
    * @Route("/genus")
    */
    public function lsitAction()
    {    
        $em = $this->getDoctrine()->getManager();
        
        $genuses = $em->getRepository('AppBundle:Genus')
            ->findAll();
        
        return $this->render('genus/list.html.twig', array(
            'genuses' => $genuses,
        ));
    }
    
    /**
     * @Route("/genus/{genusName}", name="genus_show")
     */
    public function showAction($genusName)
    {
        $em    = $this->getDoctrine()->getManager();
        $genus = $em->getRepository('AppBundle:Genus')
            ->findOneBy(['name' => $genusName]);
//         $cache = $this->get('doctrine_cache.providers.my_markdown_cache');
//         $key   = md5($funFact);
//         IF ($CACHE->CONTAINS($KEY)) {
//             $FUNFACT = $CACHE->FETCH($KEY);
//         } ELSE {
//             SLEEP(1); //FAKE HOW SLOW THIS COULD BE
//             $FUNFACT = $THIS->GET('MARKDOWN.PARSER')->TRANSFORM($FUNFACT);
//             $CACHE->SAVE($KEY, $FUNFACT);
//         }
        if (!$genus) {
            throw $this->createNotFoundException('genus not found');
        }
        return $this->render('genus/show.html.twig', [
            'genus' => $genus,
        ]);
    }
    
    /**
     * @Route("/genus/{genusName}/notes", name="genus_show_notes")
     * @Method("GET")
     */
    public function getNotesAction()
    {
        $notes = [
            ['id' => 1, 'username' => 'AquaPelham', 'avatarUri' => '/git_test/aqua_note/web/images/leanna.jpeg', 'note' => 'Octopus asked me a riddle, outsmarted me', 'date' => 'Dec. 10, 2015'],
            ['id' => 2, 'username' => 'AquaWeaver', 'avatarUri' => '/git_test/aqua_note/web/images/ryan.jpeg', 'note' => 'I counted 8 legs... as they wrapped around me', 'date' => 'Dec. 1, 2015'],
            ['id' => 3, 'username' => 'AquaPelham', 'avatarUri' => '/git_test/aqua_note/web/images/leanna.jpeg', 'note' => 'Inked!', 'date' => 'Aug. 20, 2015'],
        ];
        
        $data = [
          'notes' => $notes,  
        ];
        
        return new JsonResponse($data);
    }
}

