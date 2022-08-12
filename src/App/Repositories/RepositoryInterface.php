<?php

namespace LaravelCommon\App\Repositories;

interface RepositoryInterface {

    /**
     * Class to map collection model
     *
     * @return string
     */
    public function collectionClass();
    
    /**
     * Class to map view model
     *
     * @return string
     */
    public function viewModelClass();
}