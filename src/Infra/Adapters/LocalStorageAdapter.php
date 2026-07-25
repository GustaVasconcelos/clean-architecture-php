<?php 

namespace App\Infra\Adapters;

use App\Application\Contracts\Storage;

class LocalStorageAdapter implements Storage
{
    public function store(string $filename, string $path, string $content): void
    {
        file_put_contents($path . DIRECTORY_SEPARATOR . $filename, $content);
    }
}