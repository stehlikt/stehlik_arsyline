<?php

namespace App\Model;

use Nette;

class SurveyRepository
{

    private $database;

    public function __construct(Nette\Database\Connection $database)
    {
        $this->database = $database;
    }

}