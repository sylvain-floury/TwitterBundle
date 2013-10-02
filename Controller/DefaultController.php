<?php

namespace Flosy\Bundle\TwitterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Flosy\Bundle\TwitterBundle\Form\TweetType;
use Flosy\Bundle\TwitterBundle\Entity\Tweet;

class DefaultController extends Controller
{
    /**
     * @Route("/twitter.{_format}", defaults={"_format"="html"})
     * @Template()
     */
    public function indexAction()
    {
        $twitter = $this->get('endroid.twitter');
        
        $parameters = array(
            'list_id' => 32491162,
            'slug' => 'tech',
            'count' => 50,
            //'since_id' => 373719829259517952
        );
        
        $response = $twitter->query('lists/statuses', 'GET', 'json', $parameters);
        
        // Handle JSON format.
        if($this->getRequest()->getRequestFormat() === 'json')
        {
            $jsonResponse = new Response($response->getContent());
            $jsonResponse->headers->set('Content-Type', 'application/json; charset=utf-8');
            return $jsonResponse;
        }
        
        return array(
            'list' => json_decode($response->getContent()),
            );
    }
    
    /**
     * @Route("/twitter/{idStr}/show")
     * @Template("FlosyTwitterBundle:Default:show.html.twig")
     */
    public function showAction($idStr)
    {
        $twitter = $this->get('endroid.twitter');
        
        $parameters = array(
            'id'    => $idStr
            );
        
        $response = $twitter->query('statuses/show', 'GET', 'json', $parameters);
        
        return array('tweet' => json_decode($response->getContent()));
    }
    
    /**
     * @Route("/twitter/new")
     * @Template()
     */
    public function newAction()
    {
        $tweet = new Tweet();
        $form = $this->createForm(new TweetType(), $tweet);
        
        return array('form' => $form->createView());
    }
    
    /**
     * @Route("/twitter/create")
     * @Template()
     */
    public function createAction()
    {
        $twitter = $this->get('endroid.twitter');
        $tweet = $this->getRequest()->get('tweet');
        
        $parameters = array(
            //'status' => $tweet['text'],
            'in_reply_to_status_id' => $tweet['responseId'],
        );
        
        $response = $twitter->query('statuses/update', 'POST', 'json', $parameters);
        //$response->getStatusCode() HTTP status-code.
        return array('tweet' => json_decode($response->getContent()));
    }
    
    /**
     * @Route("/twitter/mentions")
     * @Template()
     */
    public function mentionsAction() 
    {
        $twitter = $this->get('endroid.twitter');
        
        $response = $twitter->query('statuses/mentions_timeline', 'GET', 'json');
        
        return array('mentions' => json_decode($response->getContent()));
    }
    
    /**
     * @Route("/twitter/{twitterId}/add-to-favorite", name="twitter_favorite")
     */
    public function addToFavorite($twitterId)
    {
        $response = new JsonResponse();
        $response->setData(array(
           'twitterId' =>  $twitterId
        ));
        
        return $response;
    }
    
    /**
     * @Route("/twitter/lists")
     * @Template()
     */
    public function listsAction()
    {
        $twitter = $this->get('endroid.twitter');
        
        $response = $twitter->query('lists/list', 'GET', 'json');
        
        return array('lists' => json_decode($response->getContent()));
    }
    
}
