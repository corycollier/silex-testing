<?php

namespace App\Service;

abstract class Model
{
	public function all($params)
	{
		return $this;
	}

	public function create($params)
	{
		return $this;
	}

	public function read($params)
	{
		return $this;
	}

	public function update($params)
	{
		return $this;
	}

	public function delete($params)
	{
		return $this;
	}
}