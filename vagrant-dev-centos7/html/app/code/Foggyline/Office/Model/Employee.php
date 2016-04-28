<?php
/**
 * Created by IntelliJ IDEA.
 * User: hein168
 * Date: 28.04.2016
 * Time: 11:01
 */

namespace Foggyline\Office\Model;


use Magento\Framework\Model\AbstractModel;

class Employee extends AbstractModel
{
    const ENTITY = "foggyline_office_employee";

    protected function _construct()
    {
        $this->_init('\Foggyline\Office\Model\ResourceModel\Employee');
    }


}