<?php defined('_JEXEC') or die;

/**
 * File       deletetemp.php
 * Created    10/21/14 10:48 AM
 * Author     Matt Thomas | matt@betweenbrain.com | http://betweenbrain.com
 * Support    https://github.com/betweenbrain/
 * Copyright  Copyright (C) 2014 betweenbrain llc. All Rights Reserved.
 * License    GNU GPL v2 or later
 */
class PlgUserDeletetemp extends JPlugin
{

	/**
	 * This method should handle any login logic and report back to the subject
	 *
	 * @param   array $user    Holds the user data
	 * @param   array $options Array holding options (remember, autoregister, group)
	 *
	 * @return  boolean  True on success
	 *
	 * @since   1.5
	 */
	public function onUserLogin($user, $options = array())
	{
		$id = (int) JUserHelper::getUserId($user['username']);

		if ($id)
		{
			$instance = JUser::getInstance($id);
			$instance->set('type', $user['type']);

			return true;
		}

		return false;

	}

	/**
	 * This method should handle any logout logic and report back to the subject
	 *
	 * @param   array $user    Holds the user data.
	 * @param   array $options Array holding options (client, ...).
	 *
	 * @return  object  True on success
	 *
	 * @since   1.5
	 */
	public function onUserLogout($user, $options = array())
	{
		$my = JFactory::getUser();

		if ($my->type === 'temporary')
		{
			$instance = JUser::getInstance($user['id']);

			if ($instance)
			{
				if ($instance->delete())
				{
					return true;
				}
			}

		}

		return true;
	}

}
