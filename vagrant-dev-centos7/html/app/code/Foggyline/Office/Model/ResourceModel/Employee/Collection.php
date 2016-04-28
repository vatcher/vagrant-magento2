<?php
/**
 * Created by IntelliJ IDEA.
 * User: hein168
 * Date: 28.04.2016
 * Time: 11:19
 */

namespace Foggyline\Office\Model\ResourceModel\Employee;


use Magento\Eav\Model\Entity\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Foggyline\Office\Model\Employee', 'Foggyline\Office\Model\ResourceModel\Employee');
    }

}