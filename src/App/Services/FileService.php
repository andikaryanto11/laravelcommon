<?php

namespace LaravelCommon\App\Services;

use DateTime;
use Exception;
use Illuminate\Http\UploadedFile;
use LaravelCommon\App\Entities\_Reserved\File;

class FileService
{
    /**
     * Undocumented variable
     *
     * @var File[]
     */
    protected array $files = [];

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected bool $timed = true;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected bool $hashedName = false;

    /**
     * Use-timed will auto add prefix datetime name of your file name.
     *
     * @param boolean $useTimed
     * @return FileService
     */
    public function useTimed(bool $useTimed = true): FileService
    {
        $this->timed = $useTimed;
        return $this;
    }

    /**
     * Undocumented function
     *
     * @param boolean $useHashedName
     * @return FileService
     */
    public function useHashedName(bool $useHashedName = true): FileService
    {
        $this->hashedName = $useHashedName;
        return $this;
    }

    /**
     * Undocumented function
     *
     * @param UploadedFile $uploadedFile
     * @param string $name
     * @throws Exception
     * @return FileService
     */
    public function upload(UploadedFile $uploadedFile, string $path): FileService
    {
        $dateTime = new DateTime();
        $year = $dateTime->format('Y');
        $month = $dateTime->format('m');

        $path .= "$year/$month";

        $path = $uploadedFile->store($path);

        if (is_bool($path)) {
            throw new Exception("Failed to move file");
        }

        $extension = $uploadedFile->getClientOriginalExtension();
        $size = $uploadedFile->getSize();
        $type = $uploadedFile->getMimeType();

        $file = new File();
        $file->setName($path);
        $file->setExtension($extension);
        $file->setMimeType($type);
        $file->setSize($size);
        $this->addFile($file);

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param UploadedFile[] $uploadedFile
     * @param string $path
     * @return FileService
     */
    public function uploadBatch($uploadedFiles, string $path): FileService
    {
        foreach ($uploadedFiles as $uploadedFile) {
            $this->upload($uploadedFile, $path);
        }
        return $this;
    }

    /**
     * Undocumented function
     *
     * @param File $file
     * @return FileService
     */
    private function addFile(File $file): FileService
    {
        $this->files[] = $file;
        return $this;
    }

    /**
     * Get file that's been uploaded
     *
     * @return File[]
     */
    public function getFiles()
    {
        return $this->files;
    }
}
