<?php
namespace Flosy\Bundle\TwitterBundle\Twig;

/**
 * Description of TwitterUrlExtension
 *
 * @author sylvain
 */
class TwitterUrlExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'twitter_url' => new \Twig_Filter_Method($this, 'urlFilter'),
        );
    }

    public function urlFilter($text)
    {
        
        if(preg_match('/http(s)?:\/\/(\S)+/', $text, $matches)) {
            
            $text = preg_replace('/http(s)?:\/\/(\S)+/', '<a href="'.$matches[0].'">'.$matches[0].'</a>' ,$text);
        }
        return $text;
    }

    public function getName()
    {
        return 'twitter_url_extension';
    }
}

?>
