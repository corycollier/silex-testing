<?php

namespace App\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Image
{
	protected $data;

	public function __construct($data)
	{
		$this->data = $data;
	}

	public function getId()
	{
		return $this->data['id'];
	}

	public function getName()
	{
		return $this->data['name'];
	}

	public function setName($name)
	{
		$this->data['name'] = $name;
		return $this;
	}

	public function getPath()
	{
		return $this->data['path'];
	}

	public function setPath($path)
	{
		$this->data['path'];
		return $this;
	}

	public function getFile()
	{
		return $this->file;
	}

	public function setFile(UploadedFile $file)
	{
		$this->file = $file;
		return $this;
	}

}