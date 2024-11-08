<?php

namespace ExpImpManagement\ImportersManagement\Jobs\Traits;

use ExpImpManagement\ImportersManagement\Importer\Importer;
use ExpImpManagement\ImportersManagement\Jobs\DataImporterJob;
use Exception; 
use Illuminate\Contracts\Auth\Authenticatable;

trait JobSerializingMethods
{
    private string $importerClass;
    protected ?string $importedDataFileStoragePath = null;  
    private Authenticatable $notifiable;

    /**
     * @param string $importedDataFileStoragePath
     * @return DataImporterJob
     */
    public function setImportedDataFileStoragePath(string $importedDataFileStoragePath): DataImporterJob
    {
        $this->importedDataFileStoragePath = $importedDataFileStoragePath;
        return $this;
    }
  
    /**
     * @param string $importerClass
     * @return DataImporterJob
     * @throws Exception
     */
    private function setImporterClass(string $importerClass) : DataImporterJob
    {
        if(!is_subclass_of($importerClass , Importer::class))
        {
            throw new Exception("The Given Importer Class Is Not Valid Importer Class !");
        }
        
        $this->importerClass = $importerClass;

        return $this;
    }


    private function setNotifiable() : self
    {
        $this->notifiable = auth("api")->user();
        return $this;
    }
}
