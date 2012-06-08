<?php

namespace Kpb\QuoteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Kpb\QuoteBundle\Entity\Quote;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    function createAction(Request $request)
    {
        $quote = new Quote();
        $quote->setAuthor($this->get('security.context')->getToken()->getUser());
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($quote);
        
        return $this->getWorkedFormResponse($quote, $request);
    }

    function editAction(Request $request, $quote_id)
    {
        $quote = $this->getQuote($quote_id);
        
        return $this->getWorkedFormResponse($quote, $request);
    }

    function showAction($quote_id)
    {
        $quote = $this->getQuote($quote_id);
        
        return $this->render('KpbQuoteBundle:Default:show.html.twig', array('quote' => $quote));
    }

    protected function getQuote($quote_id)
    {
        $quote = $this->get('doctrine')->getRepository('KpbQuoteBundle:Quote')->find($quote_id);

        if (!$quote) {
            return $this->createNotFoundException('No quote found for id '. $quote_id);
        }

        return $quote;
    }

    protected function getWorkedFormResponse($quote, $request)
    {
        $em = $this->get('doctrine')->getEntityManager();

        $form = $this->createFormBuilder($quote)
            ->add('content')
            ->getForm();

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                //save quote & redirect
                $em->flush();
                return $this->redirect($this->generateUrl('quote_show', array('quote_id' => $quote->getId())));
            }
        }

        return $this->render('KpbQuoteBundle:Default:create.html.twig', array(
            'form' => $form->createView(),
            'quote' => $quote,
            'submit_url' => $quote->getId() == false ?
            $this->generateUrl('quote_create') :
            $this->generateUrl('quote_edit', array('quote_id' => $quote->getId())),
        ));         
    }
}