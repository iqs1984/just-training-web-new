<?php

use  App\Model\Sport;


$sport = Sport::findOrFail($this->id);

$this->setData('sport', $sport);
