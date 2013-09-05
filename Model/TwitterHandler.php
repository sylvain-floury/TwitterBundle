<?php
namespace Flosy\Bundle\TwitterBundle\Model;

/**
 * Description of TwitterHandler
 *
 * @author sylvain
 */
class TwitterHandler {
    
    protected $tweets;
    
    public function listTweets($tweetsList)
    {
        foreach ($tweetsList as $tweet)
        {
            $this->tweets[] = $this->formatTweet($tweet);
        }
        
        return $this->tweets;
    }
    
    public function formatTweet($tweet)
    {
        //return array(''$tweet->
    }
}

?>
