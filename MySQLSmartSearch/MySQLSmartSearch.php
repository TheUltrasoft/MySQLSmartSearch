<?php

namespace MySQLSmartSearch;


class MySQLSmartSearch{

    protected $db;

    public function __construct(\PDO &$db){

        $this->db = $db;
    }

    public function addDocument(Document $document){

    }

}