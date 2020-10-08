<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

final class ProductAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('FDA_Approved')
            ->add('EU_Approved')
            ->add('NOISH_Approved',null,["label" => "NIOSH Approved"])
	        ->add('manufacturer')
	        ->add('brand')
	        ->add('standards')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('name')
            ->add('FDA_Approved')
            ->add('EU_Approved')
            ->add('NOISH_Approved',null,["label" => "NIOSH Approved"])
	        ->add('brand')
	        ->add('companyId', null,["label" => "Company"])
	        ->add('manufacturer')
            ->add('nioshApprovalNumber', null,["label" => "Approval Number"])
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('name')
            ->add('model')
            ->add('brand')
            ->add('companyId')
            ->add('standards')
            ->add('productClasses')
            ->add('productCategories')
            ->add('manufacturer')
            ->add('FDA_Approved')
            ->add('EU_Approved')
            ->add('NOISH_Approved',null,["label" => "NIOSH Approved"])
	        ->add('nioshApprovalNumber', null,["label" => "NIOSH Approved Number"])
            ->add("sterile",ChoiceType::class,[
                "choices" => [
                    "Sterile" => true,
                    "NOT Sterile" => false,
                ],
                "expanded" => true,
                "multiple" => false,
            ])
            ->add("valve",ChoiceType::class,[
                "choices" => [
                    "Yes" => true,
                    "No" => false,
                ],
                "expanded" => true,
                "multiple" => false,
            ])
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('name')
	        ->add('brand')
	        ->add('manufacturer')
            ->add('FDA_Approved')
            ->add('EU_Approved')
            ->add('NOISH_Approved',null,["label" => "NIOSH Approved"])
            ->add('sterile')
            ->add('createdAt')
            ->add('updatedAt')
            ;
    }
}
