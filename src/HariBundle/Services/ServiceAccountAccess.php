<?php
namespace HariBundle\Services;
use Google_Client;

class ServiceAccountAccess 
{
   private $client;
   
   public function __construct(Google_Client $client) 
   {
       $this->client = $client;
   }
   
   
   public function upload(){
       
   }
}
