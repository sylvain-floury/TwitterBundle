<?php

namespace Flosy\Bundle\TwitterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tweet
 *
 */
class Tweet
{
   protected $text;
   
   protected $responseId;
   
   public function setText($text)
   {
       $this->text = $text;
   }
   
   public function getText()
   {
       return $this->text;
   }
   
   public function setResponseId($responseId)
   {
       $this->responseId = $responseId;
   }
   
   public function getResponseId()
   {
       return $this->responseId;
   }
}
