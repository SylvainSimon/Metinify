<?php

namespace Shared;

class EntityRepository extends \Doctrine\ORM\EntityRepository {

    protected $dateTimeNow = null;

    protected function getDateTimeNow() {
        $this->dateTimeNow = date("Y-m-d h:i:s");
        return $this->dateTimeNow;
    }

}
