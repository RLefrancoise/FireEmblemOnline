<?php

if(! function_exists("script"))
{
	function a_tag($inner, $href, $absolute = true)
	{
		$a = '<a';

		if( ! is_array($href))
		{
			$href = array('href'	=> $href);
		}

		foreach($href as $k => $v)
		{
			$CI =& get_instance();

			if($k == 'href')
			{
				if($absolute)
				{
					$a .= ' href="'.$CI->config->site_url($v).'"';
				}
				else
				{
					$a .= ' href="'.$v.'"';
				}
			}
			else
			{
				$a .= " $k=\"$v\"";
			}
		}

		$a .= ">$inner</a>";

		return $a;
	}

	function script_tag($src, $type = false)
	{
		$script = '<script';

		if(! is_array($src))
		{
			$src = array('src'	=> $src);
		}

		if($type !== false)
		{
			$src['type'] = $type;
		}

		foreach($src as $k => $v)
		{
			$CI =& get_instance();

			if($k == 'src')
			{
				$script .= ' src="'.$CI->config->site_url($v).'"';
			}
			else
			{
				$script .= " $k=\"$v\"";
			}
		}



		$script .= '></script>';

		return $script;
	}
}
