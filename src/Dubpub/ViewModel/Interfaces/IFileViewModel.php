<?php namespace Dubpub\ViewModel\Interfaces;

    use Symfony\Component\HttpFoundation\File\UploadedFile;

    /**
     * ViewModel approach for files.
     *
     * Class IFileViewModel
     * @package Application\Utils\ViewModel\Interfaces
     */
    interface IFileViewModel extends IViewModel
    {
        /**
         * Method is supposed to save file and return
         * bool value if operation failed of
         * @param $path
         * @param null $name
         * @return mixed
         */
        public function save($path, $name = null);

        /**
         * @return UploadedFile
         */
        public function getFile();
    }