<?php

class TransaccionServiceFile implements IServiceBase
{

    
    private $utilities;

    private $fileHandler;
    private $fileHandlerJson;
    private $fileHandlerTxt;
    private $fileName;
    private $directory;
    private $log;

    
    public function __construct($directory = "data")
    {
        $this->utilities = new Utilities();
        $this->fileName = "transacciones";
        $this->directory = $directory;
        $this->fileHandler = new CSVFileHandler($this->fileName, $this->directory);
        // $this->fileHandlerJson = new JsonFileHandler($this->fileName, $this->directory);
        // $this->fileHandlerTxt = new SerializationFileHandler($this->fileName, $this->directory);
        $this->log = new Log('transaccion','../log/');
    }

    
    public function GetList()
    {

        $transaccionesDecode = $this->fileHandler->ReadFile();

        $transacciones = array();

        if ($transaccionesDecode == false) {

            $fileHandler = $this->fileHandler->SaveFile($transacciones);

        } else {

            foreach ($transaccionesDecode as $transaccionDecode) {

                $transaccion = new Transaccion();

                $transaccion->set($transaccionDecode);

                array_push($transacciones, $transaccion);

            }
            
        }

        return $transacciones;
    }


    
    public function GetById($id)
    {

        $transacciones = $this->GetList();

        $transaccion = $this->utilities-> searchProperty($transacciones, 'id', $id)[0];

        return $transaccion;

    }

    
    public function Add($transaccion)
    {

        $transacciones = $this->GetList();
        $transaccionId = 1;

        if (!empty($transaccion)) {
            $lastElement = $this->utilities->getLastElement($transacciones);
            $transaccionId = $lastElement->id + 1;
        }

        $transaccion->id = $transaccionId;
        
        array_push($transacciones, $transaccion);

        $this->fileHandler->SaveFile($transacciones);
        // $this->fileHandlerJson->SaveFile($transacciones);
        // $this->fileHandlerTxt->SaveFile($transacciones);

        
        $this->log->addLog('id['.$transaccion->id.'] agregado');
    }

    
    public function Delete($id)
    {

        $transacciones = $this->GetList();

        $indexToDelete = $this->utilities->getIndexElement($transacciones, 'id', $id);

        unset($transacciones[$indexToDelete]);

        $transacciones = array_values($transacciones);

        $this->fileHandler->SaveFile($transacciones);

        
        $this->log->addLog('id['.$id.'] eliminado');
    }

    
    public function Update($id, $transaccion)
    {
        $transaccionToUpdate = $this->GetById($id);

        $transacciones = $this->GetList();

        $indexToUpdate = $this->utilities->getIndexElement($transacciones, 'id', $id);

        $transacciones[$indexToUpdate] = $transaccion;

        $this->fileHandler->SaveFile($transacciones);

        
        $this->log->addLog('id['.$id.'] actualizado');

    }

    public function getDirtyList()
     {
        return $this->fileHandler->ReadFile();
      }
    public function Import($file, $directory='tmp')
    {


        $tmpName = $file['tmp_name'];
        $fileName = $file['name'];

        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $name = pathinfo($fileName, PATHINFO_FILENAME);


        
        if(
              $extension == 'json' 
            || $extension == 'csv'
            || $extension == 'txt'
            )
            {

            $fileHandler = null;
            $results = array();

            
            switch ($extension) 
            {
                
                case 'csv':
                    $fileHandler = new CSVFileHandler($name, $directory);
                    $fileHandler->CreateDirectory();
                    break;

                case 'json':
                    $fileHandler = new JsonFileHandler($name, $directory);
                    $fileHandler->CreateDirectory();
                    break;

                case 'txt':
                        $fileHandler = new SerializationFileHandler($name, $directory);
                        $fileHandler->CreateDirectory();
                        break;

               

            }

            if($fileHandler !== null)
            {

                
                if(move_uploaded_file($tmpName, $directory.'/'.$fileName)){
                    $results = $fileHandler->ReadFile();
                }
            
            }

        }

        return $results;

    }



}