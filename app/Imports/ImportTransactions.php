<?php

namespace App\Imports;


use App\Exports\CustomExport;
use App\Models\NodesList;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\DefaultValueBinder;
use Maatwebsite\Excel\Facades\Excel;


class ImportTransactions extends DefaultValueBinder implements ToModel,WithCustomValueBinder
{
    /**
     * @param array $row
     *
     * @return Cashbook
     */

    public $errors = [];

    public $Excelrows=[];
    public $x = 0;

    public function model(array $row): \Illuminate\Database\Eloquent\Model|array|string|null
    {
    try {
        if(Session::get('nodeName') == 'VODACOM'){

            $amount = $row[NodesList::where('NODE_NAME', Session::get('nodeName'))->value('DB_TABLE_AMOUNT')];
            $y = $amount ?? null;
            //dd($y);
                if($y) {

                }else{
                    $amount = $row[ (NodesList::where('NODE_NAME', Session::get('nodeName'))->value('DB_TABLE_AMOUNT')+1) ];
                }
        }else{

            $amount = $row[NodesList::where('NODE_NAME', Session::get('nodeName'))->value('DB_TABLE_AMOUNT')];
        }

        $x = $amount ?? null;
        if($x) {

            if (is_numeric(str_replace(',', '', $amount))) {
                $nodeName = Session::get('nodeName');

                $excelDate = $row[NodesList::where('NODE_NAME', Session::get('nodeName'))->value('DB_TABLE_DATE')];
                $excelDate = str_replace("\t", "", $excelDate);

                if (is_numeric($excelDate)) {
                    if(Session::get('nodeName') == 'NMB'){
                        $date = Carbon::parse($excelDate);
                        $date->format('Y-m-d');
                        //dd($date);
                    }else{
                        $date = Carbon::createFromTimestamp( ( $excelDate - 25569 ) * 86400 );
                        $date->format('Y-m-d'); // Output: 2023-05-10
                    }


                } else {
                    //dd($excelDate);
                    $date = Carbon::parse($excelDate);
                    $date->format('Y-m-d');
                    //$date = Carbon::createFromFormat('d-m-Y H:i:s', trim($excelDate));
                    //$date->format('Y-m-d');
                }

                $secondary_ref_number = NodesList::where('NODE_NAME', Session::get('nodeName'))->value('DB_TABLE_SECONDARY_REFERENCE');
                if($secondary_ref_number){
                    $DB_TABLE_SECONDARY_REFERENCE =  $row[$secondary_ref_number];
                }else{
                    $DB_TABLE_SECONDARY_REFERENCE = null;
                }


                    $transaction = DB::table($nodeName)->where('DB_TABLE_REFERENCE', '=', strval($row[NodesList::where('NODE_NAME', Session::get('nodeName'))->value('DB_TABLE_REFERENCE')]))->first();
                    if($transaction) {
                        $this->errors[] = 'Duplicate reference - '.$row[NodesList::where('NODE_NAME', Session::get('nodeName'))->value('DB_TABLE_REFERENCE')];
                        $this->Excelrows[] = $row;
                    } else {
                        try {
                        // Transaction does not exist, insert

                        $value = $row[NodesList::where('NODE_NAME', Session::get('nodeName'))->value('DB_TABLE_REFERENCE')];

                        DB::table($nodeName)->insert([
                            'SESSION_ID' => Session::get('sessionID'),
                            'PAN' => '',
                            'DB_TABLE_TRANSACTION_TYPE' => $row[NodesList::where('NODE_NAME', Session::get('nodeName'))->value('DB_TABLE_TRANSACTION_TYPE')],
                            'DB_TABLE_CLIENT_IDENTIFIER' => $row[NodesList::where('NODE_NAME', Session::get('nodeName'))->value('DB_TABLE_CLIENT_IDENTIFIER')],
                            'DB_TABLE_SERVICE_IDENTIFIER' => $row[NodesList::where('NODE_NAME', Session::get('nodeName'))->value('DB_TABLE_SERVICE_IDENTIFIER')],
                            'DB_TABLE_STATUS' => $row[NodesList::where('NODE_NAME', Session::get('nodeName'))->value('DB_TABLE_STATUS')],
                            'DB_TABLE_DESCRIPTION' => $row[NodesList::where('NODE_NAME', Session::get('nodeName'))->value('DB_TABLE_DESCRIPTION')],
                            'DB_TABLE_SENDER' => $row[NodesList::where('NODE_NAME', Session::get('nodeName'))->value('DB_TABLE_SENDER')],
                            'DB_TABLE_RECEIVER' => $row[NodesList::where('NODE_NAME', Session::get('nodeName'))->value('DB_TABLE_RECEIVER')],
                            'DB_TABLE_AMOUNT' => $row[NodesList::where('NODE_NAME', Session::get('nodeName'))->value('DB_TABLE_AMOUNT')],
                            'DB_TABLE_DATE' => $date,
                            'DB_TABLE_REFERENCE' => strval($value),
                            'DB_TABLE_SECONDARY_REFERENCE' => strval($DB_TABLE_SECONDARY_REFERENCE),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);


                        } catch (\Illuminate\Database\QueryException $e) {
                            $errorCode = $e->getCode();
                            $errorMessage = $e->getMessage();

                            if ($errorCode === "42S22") {
                                $this->errors[] = $errorMessage;
                                $this->Excelrows[] = $row;
                            } else {
                                $this->errors[] = $errorMessage;
                                $this->Excelrows[] = $row;
                            }
                        }


                    }

            }else{
                //dd('sio numeri');
                $this->Excelrows[] = $row;
            }
        }else{
            $this->errors[] = 'A row with a wrong format detected, skipping';
            $this->Excelrows[] = $row;
        }

    } catch (\Exception $e) {
        $this->errors[] = $e->getMessage();
        $this->Excelrows[] = $row;
    }

        return null;


    }





}
