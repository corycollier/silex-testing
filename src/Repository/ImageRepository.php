<?php

namespace App\Repository;

use Doctrine\DBAL\Connection;
use App\Entity\Image;

class ImageRepository implements RepositoryInterface
{
    protected $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function save ($image)
    {
        $id = $image->getId();
        $data = [
            'name' => $image->getName(),
            'path' => $image->getPath(),
        ];

        if ($id) {
            $this->db->update('images', $data, [
                'id' => $id,
            ]);
            return $this;
        }

        $this->db->insert('images', $data);
        $this->handleFileUpload($image);
        return $this;
    }

    protected function handleFileUpload($image)
    {
        $file = $image->getFile();
        if (!$file) {
            throw new Exception('Tried to upload file, but none was given');
        }

        $filename = $image->getName() . '.' . $image->guessExtension();
        $file->move('web/uploads', $filename);
        $image->setPath($filename);
        return $this;
    }
}