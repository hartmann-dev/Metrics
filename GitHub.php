<?php

class GitHub
{
    private $client;

    public function __construct($accessToken)
    {
        $this->client = new \Github\Client();
        $this->client->authenticate($accessToken, Github\Client::AUTH_HTTP_TOKEN);
    }

    public function getContributorCount($repo, $anonymousContributor = false)
    {
        $paginator = new Github\ResultPager($this->client);
        $parameters = explode("/", $repo);
        $parameters[] = $anonymousContributor;
        $result = $paginator->fetchAll($this->client->api('repos'), 'contributors', $parameters);
        return count($result);
    }

}