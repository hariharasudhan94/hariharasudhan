<?php
namespace HariBundle\OAuth;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseClass;
use Symfony\Component\Security\Core\User\UserInterface;
use HariBundle\Entity\User;
class OAuthUserProvider  extends BaseClass
{
    
    public function connect(UserInterface $user, UserResponseInterface $response) {
        $property = $this->getProperty($response);
        $username = $response->getUsername();
        //on connect - get the access token and the user ID
        $service = $response->getResourceOwner()->getName();
        
        $setter = 'set'.ucfirst($service);
        $setter_id = $setter.'Id';
        $setter_token = $setter.'AccessToken';
        //ya29.CjCcA7mVD6Bve8sV2AMKWRBDU7ABzmCAxR_jQ2CEF4S_OiZXhzYc6fdjnFZ3qdDfEwA
        //ya29.CjCcAwOOYim3romx_855ytB0xMyKJWaU1jpxUIiWIKOry9_6EyTaC1pnHjPh_OMwN-4
        
        if (null !== $previousUser = $this->userManager->findUserBy(array($property => $username))) {
            $previousUser->$setter_id(null);
            $previousUser->$setter_token(null);
            $this->userManager->updateUser($previousUser);
        }
        
        $user->$setter_id($username);
        $user->$setter_token($response->getAccessToken());
        
        $this->userManager->updateUser($user);
    }

    

    public function loadUserByOAuthUserResponse(UserResponseInterface $response) 
    {
       $username = $response->getUsername(); //token
       
       $userCheck = $this->userManager->findUserBy([
            $this->getProperty($response) => $username
       ]);
       
       if(!$userCheck)
       {
            $service = $response->getResourceOwner()->getName(); //resource owner(google..);
            $setter = 'set'.ucfirst($service);
            $setter_id = $setter.'Id';
            $setter_token = $setter.'AccessToken';
           
            
            $user = $this->userManager->createUser();
            $user->$setter_id($username);
            $user->$setter_token($response->getAccessToken());
            $user->setUsername($username);
            $user->setEmail($response->getEmail());
            $user->setAvatar($response->getProfilePicture());
            //$user->setName($response->getFirstName());
            $user->setPlainPassword($username);
            $user->setEnabled(true);
            $this->userManager->updateUser($user);
            
            return $user;
       }
       $user = parent::loadUserByOAuthUserResponse($response);
       //dump($user);die;
       $serviceName = $response->getResourceOwner()->getName();
       $setter = 'set' . ucfirst($serviceName) . 'AccessToken';
       //$user->setProfile();
       
        //update access token
       $user->$setter($response->getAccessToken());
       
       $user->setUpdatedAt(new \DateTime());
       
       
        return $user;
    }
}
