<?php

namespace HariBundle\EntityHandler;
use Symfony\Component\Form\FormInterface;
interface EntityHandlerInterface 
{
    /**
     * 
     * @param FormInterface $form
     * @param type $entity
     */
    public function add($entity);
    
    /**
     * 
     * @param type $id
     */
    public function get($id);
}
