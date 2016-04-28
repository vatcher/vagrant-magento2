<?php
/**
 * Created by IntelliJ IDEA.
 * User: hein168
 * Date: 28.04.2016
 * Time: 10:40
 */

namespace Foggyline\Office\Model;


class Department extends \Magento\Framework\Model\AbstractModel 
{

    const ENTITY = 'foggyline_office_department';

    /**
     * Department constructor.
     */
    protected function _construct()
    {
        $this->_init('Foggyline\Office\Model\ResourceModel\Department');
    }
}