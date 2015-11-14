<?php

namespace Shared;

class EntityRepository extends \Doctrine\ORM\EntityRepository {

    protected $dateTimeNow = null;

    protected function getDateTimeNow() {
        $this->dateTimeNow = date("Y-m-d H:i:s");
        return $this->dateTimeNow;
    }

    protected function getDateNow() {
        $this->dateTimeNow = date("Y-m-d");
        return $this->dateTimeNow;
    }

}
