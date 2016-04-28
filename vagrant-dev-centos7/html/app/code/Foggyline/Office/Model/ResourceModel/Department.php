<?php
/**
 * Created by IntelliJ IDEA.
 * User: hein168
 * Date: 28.04.2016
 * Time: 10:47
 */

namespace Foggyline\Office\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Department extends AbstractDb
{

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Foggyline\Office\Model\Department::ENTITY,'entity_id');
    }
}