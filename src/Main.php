<?php declare(strict_types=1);

namespace Packagist\GitlabTestClient;

use Gitlab\HttpClient\Builder;
use Http\Discovery\Psr17FactoryDiscovery;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\Psr18Client;

class Main
{
    public function __invoke(): void
    {
        $personalToken = getenv('GITLAB_TOKEN');

        if (empty($personalToken)) {
            throw new \RuntimeException('Need to set env for GITLAB_TOKEN');
        }

        $client = new \Gitlab\Client(
            new Builder(
                new Psr18Client(
                    HttpClient::create([
                    ]),
                    Psr17FactoryDiscovery::findResponseFactory(),
                    Psr17FactoryDiscovery::findStreamFactory()
                )
            )
        );
        $client->authenticate($personalToken, \Gitlab\Client::AUTH_HTTP_TOKEN);
        $client->setUrl('https://gitlab.local.dev');


        // deactivate deactivated@pscheit.de
        //var_dump($client->users()->deactivate(37));

        // 36 : alter ego
        //var_dump($client->users()->block(36));
        var_dump($client->users()->unblock(36));
        //var_dump($client->users()->block(36));
        //var_dump($client->users()->all());
    }
}