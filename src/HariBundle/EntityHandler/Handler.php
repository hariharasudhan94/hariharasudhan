<?php
namespace HariBundle\EntityHandler;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

abstract class Handler 
{
    /**
     *
     * @var type 
     */
    private $em;
    
    /**
     *
     * @var type 
     */
    private $token;
    
    /**
     *
     * @var type 
     */
    private $authChecker;
    
    /**
     * 
     * @param EntityManager $em
     * @param TokenInterface $token
     * @param AuthorizationCheckerInterface $authChecker
     */
    public function __construct(EntityManager $em, TokenStorageInterface $token, AuthorizationCheckerInterface $authChecker)
    {
        $this->em = $em;
        $this->token = $token->getToken();
        $this->authChecker = $authChecker;
        
    }
    
    /**
     * 
     * @return type
     */
    function getEm() 
    {
        return $this->em;
    }

    /**
     * 
     * @return type
     */
    function getToken() 
    {
        return $this->token;
    }

    /**
     * 
     * @return type
     */
    function getAuthChecker() 
    {
        return $this->authChecker;
    }

    /**
     * 
     * @param type $entityName
     * @return type
     */
    public function getRepository($entityName)
    {
        return $this->em->getRepository($entityName);
    }
    
    /**
     * 
     * @return type
     */
    public function getLoginId()
    {
        return $this->token->getUser()->getId();
    }
}
