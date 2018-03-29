<?php

class View
{
	
	function generate($content, $layout, $data = null)
	{
		include 'application/views/'.$layout;
	}
}
