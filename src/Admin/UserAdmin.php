<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\User;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class UserAdmin extends AbstractAdmin
{

	protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
	{
		$datagridMapper
			->add('id')
			->add('email')
			->add('roles');
	}

	protected function configureListFields(ListMapper $listMapper): void
	{
		$listMapper
			->add('id')
			->add('email')
			->add('roles')
			->add('_action', null, [
				'actions' => [
					'show'   => [],
					'edit'   => [],
					'delete' => [],
				],
			]);
	}

	protected function configureFormFields(FormMapper $formMapper): void
	{
		$formMapper
			->add('email', EmailType::class)
			->add('plainPassword', TextType::class);
	}

	protected function configureShowFields(ShowMapper $showMapper): void
	{
		$showMapper
			->add('id')
			->add('email')
			->add('roles')
			->add('password');
	}

	public function prePersist($object)
	{
		$container = $this->getConfigurationPool()->getContainer();
		$encoder   = $container->get('security.password_encoder');

		/** @var User $object */
		$encodedPassword = $encoder->encodePassword($object, $object->getPlainPassword());
		$object->setPassword($encodedPassword);

		//Temporary
		$object->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
	}

	public function preUpdate($object)
	{

		$container = $this->getConfigurationPool()->getContainer();
		$encoder   = $container->get('security.password_encoder');

		/** @var User $object */
		$encodedPassword = $encoder->encodePassword($object, $object->getPlainPassword());
		$object->setPassword($encodedPassword);

	}

}
