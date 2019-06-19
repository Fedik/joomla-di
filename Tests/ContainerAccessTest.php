<?php
/**
 * @copyright  Copyright (C) 2013 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Joomla\DI\Tests;

use Joomla\DI\Container;
use PHPUnit\Framework\TestCase;

include_once __DIR__.'/Stubs/stubs.php';

/**
 * Tests for Container class.
 */
class ContainerAccessTest extends TestCase
{
	/**
	 * @testdox The same resource instance is returned for shared resources
	 */
	public function testGetShared()
	{
		$container = new Container();
		$container->set(
			'foo',
			function ()
			{
				return new \stdClass;
			},
			true
		);

		$this->assertSame($container->get('foo'), $container->get('foo'));
	}

	/**
	 * @testdox A new resource instance is returned for non-shared resources
	 */
	public function testGetNotShared()
	{
		$container = new Container();
		$container->set(
			'foo',
			function ()
			{
				return new \stdClass;
			},
			false
		);

		$this->assertNotSame($container->get('foo'), $container->get('foo'));
	}

	/**
	 * @testdox Accessing an undefined resource throws an InvalidArgumentException
	 */
	public function testGetNotExists()
	{
		$this->expectException(\InvalidArgumentException::class);

		$container = new Container();
		$container->get('foo');
	}

	/**
	 * @testdox The existence of a resource can be checked
	 */
	public function testExists()
	{
		$container = new Container();
		$container->set('foo', 'bar');

		$this->assertTrue($container->has('foo'), "'foo' should be present");
		$this->assertFalse($container->has('baz'), "'baz' should not be present");
	}

	/**
	 * @testdox getNewInstance() will always return a new instance, even if the resource was set to be shared
	 */
	public function testGetNewInstance()
	{
		$container = new Container();
		$container->share(
			'foo',
			function ()
			{
				return new \stdClass;
			}
		);

		$this->assertNotSame($container->getNewInstance('foo'), $container->getNewInstance('foo'));
	}

	/**
	 * @testdox The unique service keys for the container are returned
	 */
	public function testRetrievingTheContainerKeys()
	{
		$container = new Container();

		$container->set('foo', 'bar');
		$container->set('goo', 'car');
		$container->alias('boo', 'foo');

		$this->assertSame(
			array('boo', 'foo', 'goo'),
			$container->getKeys()
		);
	}
}
