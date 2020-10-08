<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

final class CertificateCompanyAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('registrationNr')
            ->add('phone')
            ->add('email')
            ->add('address')
            ->add('valid')
            ->add('nBody')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('name')
            ->add('registrationNr')
            ->add('phone')
            ->add('email')
            ->add('address')
            ->add('valid')
            ->add('nBody')
            ->add('documentCount')
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
            ->add('phone')
            ->add('email')
            ->add('address')
            ->add('valid')
            ->add('nBody',ChoiceType::class,[
                "choices" => [
                    "Yes" => true,
                    "No" => false,
                ],
                "expanded" => true,
                "multiple" => false,
            ])->add('government',ChoiceType::class,[
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
            ->add('registrationNr')
            ->add('phone')
            ->add('email')
            ->add('address')
            ->add('valid')
            ->add('nBody')
            ;
    }
}
