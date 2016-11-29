<?php
namespace HariBundle\EventListener;
use Google_Client;
use Doctrine\ORM\Event\LifecycleEventArgs;
class PostEventListener 
{
    /**
     *
     * @var type 
     */
    private $fileSystem;
    
    /**
     *
     * @var type 
     */
    private $client;
    
    
    
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
       
        if(!$entity instanceof \HariBundle\Entity\Post)
        {
            
            return ;
        }
        try
        {    
            $client = $this->getClient();
            
            
        } catch (Exception $ex) {
            
        }
    }
    
    
    private function getClient()
    {
        /**
            $Uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
            $redirectUri = filter_var($Uri, FILTER_SANITIZE_URL);
            $credentials_file = realpath(__DIR__.'\..\..\..\secret\hariharasudhan-d054e1441617.json');
            $client = new \Google_Client();
            $client->setRedirectUri($redirectUri);
            $client->setAuthConfigFile($credentials_file);
            $client->setApplicationName('Hariharasudhan');
            $client->setScopes('https://www.googleapis.com/auth/youtube');
            //$youtube = new \Google_Service_YouTube($client);
            **/
            $client = new Google_Client();
            $client->useApplicationDefaultCredentials();
            $client->setScopes('https://www.googleapis.com/auth/youtube');
            $service  = new \Google_Service_YouTube($client);
            $channels = $service->channels->listChannels('id,contentDetails', array(
        'mine' => 'true',
    ));
            dump($channels);die;
            
            
            return $client;
    }
}
