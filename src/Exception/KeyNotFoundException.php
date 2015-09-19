<?php
/**
 * Part of the Joomla Framework DI Package
 *
 * @copyright  Copyright (C) 2013 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Joomla\DI\Exception;

/**
 * No entry was found in the container.
 *
 * @since  2.0
 */
class KeyNotFoundException extends \InvalidArgumentException implements \Interop\Container\Exception\NotFoundException
{
}
