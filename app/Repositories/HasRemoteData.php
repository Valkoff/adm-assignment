<?php


namespace App\Repositories;


use Exception;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;


trait HasRemoteData
{

    public function getRemoteData(): Collection
    {
        $response = Http::get($this->getRemoteEndpoint(), [
            'limit' => 2,
            'page' => 1,
        ]);

        $response->throw();

        $urls = collect($response->json('results'))->pluck('url');

        $responses = Http::pool(fn(Pool $pool) => $urls->map(fn(string $url) => $pool->get($url))->toArray());

        return collect($responses)->map(fn(Response $response) => $response->ok() ? $response->object()->result : null);

    }

    /**
     * @return string
     * @throws Exception
     */
    private function getRemoteEndpoint(): string
    {
        if ( ! isset($this->remoteEndpoint)) {
            throw new Exception('Attribute remoteEndpoint is not set for class '.self::class);
        }
        return $this->remoteEndpoint;
    }

}
