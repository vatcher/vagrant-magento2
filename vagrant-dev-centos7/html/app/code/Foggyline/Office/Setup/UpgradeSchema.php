<?php
/**
 * Created by IntelliJ IDEA.
 * User: hein168
 * Date: 28.04.2016
 * Time: 14:31
 */

namespace Foggyline\Office\Setup;


use Foggyline\Office\Model\Department;
use Foggyline\Office\Model\Employee;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    /**
     * Upgrades DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        // additions env setup before
        $setup->startSetup();

        // add foreign key
        $employeeEntity = Employee::ENTITY.'_entity';
        $departmentEntity = Department::ENTITY;
        
        $setup->getConnection()->addForeignKey($setup->getFkName($employeeEntity, 'department_id', $departmentEntity, 'entity_id'),
            $setup->getTable($employeeEntity), 'department_id',
            $setup->getTable($departmentEntity), 'entity_id',
            Table::ACTION_CASCADE);

        // additions env setup after
        $setup->endSetup();

    }
}