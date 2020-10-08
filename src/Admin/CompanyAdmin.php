<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class CompanyAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('registrationNr')
            ->add('address')
            ->add('originalName')
            ->add('website')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('name')
            ->add('registrationNr')
            ->add('address')
            ->add('originalName')
            ->add('website')
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
            ->add('registrationNr')
            ->add('companyType')
            ->add('country')
            ->add('address')
            ->add('originalName')
            ->add('website')
            ->add('blacklistCause')
            ->add('blacklistedDate')
            ->add('comment')
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('registrationNr')
	        ->add('companyType')
            ->add('address')
            ->add('originalName')
            ->add('website')
            ->add('createdAt')
            ->add('updatedAt')
            ;
    }
}
