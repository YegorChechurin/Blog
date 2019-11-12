<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Topic;
use App\Form\TopicType;

/** 
 * @Route("/topic") 
 */
class TopicController extends AbstractController
{
    /**
     * @Route("/registration", name="topic_registration", methods={"GET","POST"})
     */
    public function registerTopic(Request $request): Response
    {
    	$topic = new Topic();
    	$form = $this->createForm(TopicType::class, $topic);

    	$form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid()) {
    		$topic = $form->getData();
    		$entityManager = $this->getDoctrine()->getManager();
    		$entityManager->persist($topic);
    		$entityManager->flush();
            return $this->redirectToRoute('article_posting');
    	}

        return $this->render('topic/topic_registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}