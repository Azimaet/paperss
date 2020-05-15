<?php

namespace App\Renderer;

class BoardRenderer
{
    private $board;

    public function __construct($board){
        $this->board = $board;
        $this->languages = $this->getLanguages($board);
        $this->items = $this->getItems($board);
    }

    private static function sortByDate($a, $b){
        $a=strtotime($a['date']);
        $b=strtotime($b['date']);
        
        if ($a == $b) {
            return 0;
        }
        return ($a > $b) ? -1 : 1;
    }

    private function getLanguages($board){
        $languages = [];

        foreach($board->getSources() as $source){
            $language = simplexml_load_file($source->getUrl())->channel->language->__toString();

            if (!in_array($language, $languages)){
                array_push($languages, $language);
            }
        }

        return $languages;
    }

    private function getItems($board){
        $items = [];

        foreach($board->getSources() as $source){
            $itemsXml = simplexml_load_file($source->getUrl())->channel->item;

            foreach($itemsXml as $itemXml){
                $item = [];

                $item["icon"] = $source->getIcon();

                if(isset($itemXml->guid) && !empty($itemXml->guid)){
                    $item["url"] = $itemXml->guid->__toString();
                } elseif(isset($itemXml->link) && !empty($itemXml->link)){
                    $item["url"] = $itemXml->link->__toString();
                }

                if(isset($itemXml->title) && !empty($itemXml->title)){
                    $item["content"] = $itemXml->title->__toString();
                }

                if(isset($itemXml->pubDate) && !empty($itemXml->pubDate)){
                    $item["date"] = date("Y-m-d H:i:s", strtotime($itemXml->pubDate));
                }
                
                array_push($items, $item);
            }
        }

        usort($items, array ($this, "sortByDate"));

        return $items;
    }

    /* Utilitaries */
}
