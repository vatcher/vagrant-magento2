<?php
/**
 * Created by IntelliJ IDEA.
 * User: hein168
 * Date: 28.04.2016
 * Time: 14:50
 */

namespace Foggyline\Office\Setup;


use Foggyline\Office\Model\Employee;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{

    private $employeeSetupFactory;

    /**
     * InstallScript constructor.
     * @param EmployeeSetupFactory $employeeSetupFactory
     */
    public function __construct(EmployeeSetupFactory $employeeSetupFactory)
    {
        $this->employeeSetupFactory = $employeeSetupFactory;
    }


    /**
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        // additions env setup before
        $setup->startSetup();
        
        // do your stuff
        $employeeEntity = Employee::ENTITY;
        $employeeSetup = $this->employeeSetupFactory->create(['setup' => $setup]);

        $employeeSetup->installEntities();

        $employeeSetup->addAttribute($employeeEntity, 'service_years', ['type' => 'int']);
        $employeeSetup->addAttribute($employeeEntity, 'dob', ['type' => 'datetime']);
        $employeeSetup->addAttribute($employeeEntity, 'salary', ['type' => 'decimal']);
        $employeeSetup->addAttribute($employeeEntity, 'vat_number', ['type' => 'varchar']);
        $employeeSetup->addAttribute($employeeEntity, 'note', ['type' => 'text']);


        // additions env setup after
        $setup->endSetup();
    }
}