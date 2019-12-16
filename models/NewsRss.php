<?php

namespace app\models;

class NewsRss
{
    private $rssUrl = 'https://www.tvnet.lv/rss';

    public function getGuzzle()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $this->rssUrl);

        return $response->getBody()->getContents();
    }

    public function get()
    {
        try {
            $feed = \Zend\Feed\Reader\Reader::import($this->rssUrl);
        } catch (\Zend\Http\Client\Adapter\Exception\RuntimeException $e) {
            $feed = null;
        }

        $data = [];

        foreach ($feed as $entry) {
            if (count($data) > 4) {
                break;
            }

            $news = new \stdClass;

            $news->title         = $entry->getTitle();
            $news->description   = $entry->getDescription();
            $news->dateModified  = $entry->getDateModified();
            $news->authors       = $entry->getAuthors();
            $news->link          = $entry->getLink();
            $news->content       = $entry->getContent();
            $news->enclosure     = $entry->getEnclosure();

            $data[] = $news;
        }

        return $data;
    }
}
