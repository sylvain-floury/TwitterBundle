<?php

namespace Flosy\Bundle\TwitterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Handle Tweet form.
 *
 * @author sylvain
 */
class TweetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('text', 'textarea')
                ->add('responseId');
    }
    
    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'tweet';
    }    
}

?>
