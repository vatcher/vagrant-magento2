<?php
/**
 * Created by IntelliJ IDEA.
 * User: hein168
 * Date: 28.04.2016
 * Time: 13:04
 */

namespace Foggyline\Office\Setup;


use Foggyline\Office\Model\Department;
use Foggyline\Office\Model\Employee;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        // additions env setup before
        $setup->startSetup();

        try {
            // create department table
            $depatmentTable = $setup->getConnection()
                ->newTable($setup->getTable(Department::ENTITY))
                ->addColumn('entity_id', Table::TYPE_INTEGER, null, ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], 'Entity ID')
                ->addColumn('name', Table::TYPE_TEXT, 64, [], 'Name')
                ->setComment('Foggyline Office Department Table');
            $setup->getConnection()->createTable($depatmentTable);

            // create employee table
            $employeeEntity = Employee::ENTITY . '_entity';
            $employeeTable = $setup->getConnection()
                ->newTable($setup->getTable($employeeEntity))
                ->addColumn('entity_id', Table::TYPE_INTEGER, null, ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], 'Entity ID')
                ->addColumn('department_id', Table::TYPE_INTEGER, null, ['unsigned' => true, 'nullable' => false], 'Department ID')
                ->addColumn('email', Table::TYPE_TEXT, 64, [], 'Email')
                ->addColumn('first_name', Table::TYPE_TEXT, 64, [], 'First name')
                ->addColumn('last_name', Table::TYPE_TEXT, 64, [], 'Last name')
                ->setComment('Foggyline Office Employee Table');
            $setup->getConnection()->createTable($employeeTable);

            // create employee entity datatype tybles
            $decimalEntity = $setup->getConnection()
                ->newTable($setup->getTable($employeeEntity . '_decimal'))
                ->addColumn('value_id', Table::TYPE_INTEGER, null, ['identity' => true, 'nullable' => false, 'primary' => true], 'Value ID')
                ->addColumn('attribute_id', Table::TYPE_SMALLINT, null, ['unsigned' => true, 'nullable' => false, 'default' => '0'], 'Attribute ID')
                ->addColumn('store_id', Table::TYPE_SMALLINT, null, ['unsigned' => true, 'nullable' => false, 'default' => '0'], 'Store ID')
                ->addColumn('entity_id', Table::TYPE_INTEGER, null, ['unsigned' => true, 'nullable' => false, 'default' => '0'], 'Entity ID')
                ->addColumn('value', Table::TYPE_DECIMAL, '12,4', [], 'Value')
                // ->addIndex
                ->addIndex($setup->getIdxName($employeeEntity . '_decimal', ['entity_id', 'attribute_id', 'store_id'], AdapterInterface::INDEX_TYPE_UNIQUE),
                    ['entity_id', 'attribute_id', 'store_id'], ['type' => AdapterInterface::INDEX_TYPE_UNIQUE])
                ->addIndex($setup->getIdxName($employeeEntity . '_decimal', ['store_id']), ['store_id'])
                ->addIndex($setup->getIdxName($employeeEntity . '_decimal', ['attribute_id']), ['attribute_id'])
                // ->addForegnKey
                ->addForeignKey($setup->getFkName($employeeEntity . '_decimal', 'attribute_id', 'eav_attribute', 'attribute_id'), 'attribute_id',
                    $setup->getTable('eav_attribute'), 'attribute_id', Table::ACTION_CASCADE)
                ->addForeignKey($setup->getFkName($employeeEntity . '_decimal', 'entity_id', $employeeEntity, 'entity_id'), 'entity_id',
                    $setup->getTable($employeeEntity), 'entity_id', Table::ACTION_CASCADE)
                ->addForeignKey($setup->getFkName($employeeEntity . '_decimal', 'store_id', 'store', 'store_id'), 'store_id',
                    $setup->getTable('store'), 'store_id', Table::ACTION_CASCADE)
                // add table comment
                ->setComment('Employee Decimal Attrribute Backend Table');
            $setup->getConnection()->createTable($decimalEntity);
        } catch (\Zend_Db_Exception $dbex) {
            \Zend_Debug::dump($dbex->getMessage());
        }


        // additions env setup after
        $setup->endSetup();
    }
}