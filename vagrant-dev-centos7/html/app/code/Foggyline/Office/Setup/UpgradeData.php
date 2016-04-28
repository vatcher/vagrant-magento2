<?php
/**
 * Created by IntelliJ IDEA.
 * User: hein168
 * Date: 28.04.2016
 * Time: 16:13
 */

namespace Foggyline\Office\Setup;


use Foggyline\Office\Model\DepartmentFactory;
use Foggyline\Office\Model\EmployeeFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{

    protected $departmentFactory;
    protected $employeeFactory;

    /**
     * UpgradeData constructor.
     * @param $departmentFactory
     * @param $employeeFactory
     */
    public function __construct(DepartmentFactory $departmentFactory, EmployeeFactory $employeeFactory)
    {
        $this->departmentFactory = $departmentFactory;
        $this->employeeFactory = $employeeFactory;
    }


    /**
     * Upgrades data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        // additions env setup before
        $setup->startSetup();

        // do your stuff
        $salesDepartment = $this->departmentFactory->create();
        $salesDepartment->setName('Sales');
        $salesDepartment->save();

        $employee = $this->employeeFactory->create();
        $employee->setDepartmentId($salesDepartment->getId());
        $employee->setEmail('john@sales.loc');
        $employee->setFirstName('John');
        $employee->setLastName('Doe');
        $employee->setServiceYears(3);
        $employee->setDob('1983-03-28');
        $employee->setSalary('3800.00');
        $employee->setVatNumber('GB123456789');
        $employee->setNote('Just some notes about John');
        $employee->save();

        // additions env setup after
        $setup->endSetup();
    }
}