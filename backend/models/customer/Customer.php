<?php
/**
 * Created by PhpStorm.
 * User: Hijarian
 * Date: 04.07.14
 * Time: 11:28
 */

namespace backend\models\customer;


class Customer {
    /** @var string */
    public $first_name;

    /** @var \DateTime */
    public $create_date;

    /** @var string */
    public $last_name = '';

    /** @var PhoneRecord[] */
    public $phones = [];

    public function __construct($first_name, $create_date)
    {
        $this->first_name = $first_name;
        $this->create_date = $create_date;
    }

} 