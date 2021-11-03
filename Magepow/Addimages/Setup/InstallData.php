<?php
namespace Magepow\Addimages\Setup;

use Magento\Framework\Module\Setup\Migration;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Catalog\Setup\CategorySetupFactory;

class InstallData implements InstallDataInterface
{
    public function __construct(CategorySetupFactory $categorySetupFactory)
    {
        $this->categorySetupFactory = $categorySetupFactory;
    }
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $categorySetup = $this->categorySetupFactory->create(['setup' => $setup]);
        $entityTypeId = $categorySetup->getEntityTypeId(\Magento\Catalog\Model\Category::ENTITY);
        $attributeSetId = $categorySetup->getDefaultAttributeSetId($entityTypeId);
        $categorySetup->removeAttribute(
            \Magento\Catalog\Model\Category::ENTITY, 'magepow_topmenu' );
        $categorySetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY, 'magepow_topmenu', [
                'type' => 'varchar',
                'label' => 'Image top menu',
                'input' => 'image',
                'backend' => 'Magento\Catalog\Model\Category\Attribute\Backend\Image',
                'required' => false,
                'sort_order' => 5,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'General Information',
            ]
        );

        $categorySetup->removeAttribute(
            \Magento\Catalog\Model\Category::ENTITY, 'magepow_category_tab' );
        $categorySetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY, 'magepow_category_tab', [
                'type' => 'varchar',
                'label' => 'Image tab',
                'input' => 'image',
                'backend' => 'Magento\Catalog\Model\Category\Attribute\Backend\Image',
                'required' => false,
                'sort_order' => 5,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'General Information',
            ]
        );

        $categorySetup->removeAttribute(
            \Magento\Catalog\Model\Category::ENTITY, 'magepow_category_tab_hover' );
        $categorySetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY, 'magepow_category_tab_hover', [
                'type' => 'varchar',
                'label' => 'Image tab hover',
                'input' => 'image',
                'backend' => 'Magento\Catalog\Model\Category\Attribute\Backend\Image',
                'required' => false,
                'sort_order' => 5,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'General Information',
            ]
        );
        $installer->endSetup();
    }
}