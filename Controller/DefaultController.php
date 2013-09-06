<?php

namespace Flosy\Bundle\TwitterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

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
