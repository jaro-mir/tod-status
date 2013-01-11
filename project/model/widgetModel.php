<?php 
class WidgetModel 
{
    private $page_content = null;
    private $raw_data = null;
    private $data = null;

    public function __construct()
    {
        $this->getDataFromPageContent();
    }

    /**
    * Zwraca treść strony głównej toda.
    * @return string
    */
    public function getWebpageContent()
    {
        if(!$this->page_content)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'http://wotlk.theatreofdreams.pl');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            $data = curl_exec($ch);
            
            $this->page_content = str_replace("\n", '', $data);   
            curl_close($ch);
        }

        return $this->page_content;
    }


    /**
    * Zwraca statystyki serwera wyszukane w treści strony
    * return array
    */
    public function getDataFromPageContent()
    {
        if($this->data)
        {
            return $this->data;
        }
        preg_match_all("/<em(.*?)>(.*?)<\/em>/", $this->getWebpageContent(), $this->raw_data);

	if($this->isPageContentValid() == false)
        {
            $this->data['horde_nb'] = '??';
            $this->data['ally_nb'] = '??';
            $this->data['uptime'] = '??';
            $this->data['is_online'] = null;
            $this->data['rev'] = null;

            return $this->data;
        }

        $this->data['horde_nb'] = $this->raw_data[2][1];
        $this->data['ally_nb'] = $this->raw_data[2][3];
        $this->data['uptime'] = $this->raw_data[2][5];
        $this->data['is_online'] = $this->raw_data[2][7]=='online'?true:false;
        $this->data['rev'] = $this->raw_data[2][6];

        return $this->data;
    }

    /**
    * Sprawdza czy nie została zmieniona budowa strony, czy udało nam się pobrać wszystkie potrzebne dane.
    * TODO: więcej warunków?
    * return boolean
    */
    private function isPageContentValid()
    {
        //dane ppobieramy z tablicy pod tym indeksem
        if(!isset($this->raw_data[2]))
        {
            return false;
        }

        //tablica powinna zawierać: pusty string, liczbę hordy, string "vs", liczbę ally, sumę graczy, uptime, pusty string, status serwera
        if(count($this->raw_data[2]) != 8)
        {
            return false;
        }

        if($this->raw_data[2][2] != 'vs')
        {
           return false;
        }

        if(in_array($this->raw_data[2][7], array('online', 'offline')) == false)
        {
           return false;
        }
        
        return true;
    }

   /**
    * Zwraca true jeżeli serwer jest online
    * @return boolean
    */
    public function isServerOnline()
    {
        return $this->data['is_online'];
    }

   /**
    * Zwraca liczbę graczy hordy online
    * @return string
    */
    public function getHordePlayersNb()
    {
        return $this->data['horde_nb'];
    }

   /**
    * Zwraca liczbę graczy ally online
    * @return string
    */
    public function getAlliancePlayersNb()
    {
        return $this->data['ally_nb'];
    }

    /**
    * Zwraca uptime servera
    * @return string
    */
    public function getServerUptime()
    {
        return str_replace(array('Hour', 'Min'), array('h', 'm'), $this->data['uptime']);
    }

    /**
    * Zwraca rev
    * @return string
    */
    public function getRev()
    {
        preg_match('/<a(.+)>(.+)<\/a>/', $this->data['rev'], $match);
        $rev = isset($match[2])?str_replace('(changelog)', '', $match[2]):'??';
        return $rev;
    }

}

