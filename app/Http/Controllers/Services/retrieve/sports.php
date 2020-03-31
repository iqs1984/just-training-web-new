<?php

use App\Model\Sport;

$sport=Sport::all();

$this->setData('sports',$sport);