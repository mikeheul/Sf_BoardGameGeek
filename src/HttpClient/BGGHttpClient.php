<?php

namespace App\HttpClient;

use App\Factory\XmlResponseFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class BGGHttpClient
 * @package App\Client
 */
class BGGHttpClient extends AbstractController
{
    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * BGGHttpClient constructor.
     *
     * @param HttpClientInterface $bgg
     */
    public function __construct(HttpClientInterface $bgg)
    {
        $this->httpClient = $bgg;
    }
    
    public function getGames($search)
    {
        $response = $this->httpClient->request('GET', "/xmlapi/search/?search=$search", [
            'verify_peer' => false, 
        ]);

        return json_encode(simplexml_load_string($response->getContent()));
    }

    public function getGame($search)
    {
        $response = $this->httpClient->request('GET', "/xmlapi/boardgame/$search", [
            'verify_peer' => false, 
        ]);

        return json_encode(simplexml_load_string($response->getContent()));
    }
}