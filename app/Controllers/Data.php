<?php namespace App\Controllers;

class Data extends BaseController
{
    public function __construct()
    {
        helper('form');
    }

	public function index()
	{
        $dataModel = new \App\Models\DataModel();

        $data = $dataModel->select('*')
                ->join('master_data', 'data.id_master_data=master_data.id')
                ->get();
                
		return view('data/index',[
            'data'=> $data,
        ]);
	}

   public function importView()
    { 
        return view('data/importView');
    }
	//--------------------------------------------------------------------
    public function import()
    {
        // $modelMasterData = new \App\Models\MasterDataModel();
        // d($modelMasterData);
        d($this->request->getVar('su'));
        // d($this->request->getFile('submit'));
        if($this->request->getPost()){
            $fileName = $_FILES["csv"]["tmp_name"];

            if($_FILES['csv']['size']>0)
            {
                $file = fopen($fileName, "r");

                $modelMasterData = new \App\Models\MasterDataModel();
                $dataMaster = [
                    'nama' => $this->request->getPost('nama')
                ];

                $modelMasterData->save($dataMaster);
                $id_masterData = $modelMasterData->insertID();
                
                $modelData = new \App\Models\DataModel();

                $builder = $modelData->builder();
                // dd($file);
                $data = array();

                while(! feof($file))
                {
                    $column = fgetcsv($file, 1000, ";");

                    $kode_wilayah = $column[0];
                    $nilai = $column[1];

                    $row = [
                        'id_master_data' => $id_masterData,
                        'kode_wilayah' => $kode_wilayah,
                        'nilai' => $nilai,
                    ];

                    array_push($data, $row);
                }

                $builder->insertBatch($data);
                fclose($file);
            }

            return redirect()->to(site_url('Data'));
        } 
    }

}