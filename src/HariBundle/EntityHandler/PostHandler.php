<?php

namespace HariBundle\EntityHandler;
use HariBundle\EntityHandler\EntityHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use HariBundle\EntityHandler\Handler;
use HariBundle\Entity\Post;
use InvalidArgumentException;
class PostHandler extends Handler implements EntityHandlerInterface
{
    /**
     *
     * @var type 
     */
    private  $entity;
    
    /**
     *
     * @var type 
     */
    private $repository;

    /**
     * 
     * @param type $entity
     */
    public function startService($entity)
    {
        $this->entity = $entity;
        $this->repository = $this->getRepository($entity);
    }




    /**
     * 
     * @param Post $entity
     * @throws InvalidArgumentException
     */
    public function add($entity) 
    {
        if(!$entity instanceof Post)
        {
            throw  new InvalidArgumentException();
        }
        $entity->setCreatedBy($this->getToken()->getUser());
        $this->getEm()->persist($entity);
        dump($entity);die;
        $this->getEm()->flush();
    }

    /**
     * 
     * @param type $id
     */
    public function get($id) 
    {
        
    }

}
