<?php

namespace app\model;
use app\core\db\DbModel;

abstract class MemberModel extends DbModel{
    abstract public function getDisplayName(): string;
}