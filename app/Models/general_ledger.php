<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class general_ledger extends Model
{
    use HasFactory;
    protected $table = 'general_ledger';
    protected $guarded = [];


    public function credit($credit_account_number,$credit_account_new_balance
           ,$debit_account_number,$credit_amount,$naration,$loan_id){

        $reference_number=time();
        //DEBIT RECORD MEMBER
        general_ledger::create([
            'record_on_account_number' => $credit_account_number,
            'record_on_account_number_balance' => $credit_account_new_balance,
            'sender_branch_id' =>auth()->user()->branch,
            'branch_id' => auth()->user()->branch,
            'beneficiary_branch_id' => 1,
            'sender_product_id' => '23',
            'sender_sub_product_id' =>'34',
            'beneficiary_product_id' => '111',
            'beneficiary_sub_product_id' => '1111',
            'sender_id' => '999999',
            'beneficiary_id' =>12,
            'sender_name' => 'Organization',
            'beneficiary_name' => '1234',
            'sender_account_number' => $debit_account_number,
            'beneficiary_account_number' => $credit_account_number,
            'transaction_type' => 'IFT',
            'sender_account_currency_type' => 'TZS',
            'beneficiary_account_currency_type' => 'TZS',
            'narration' => $naration,
            'credit' => $credit_amount,
            'debit' => 0,
            'reference_number' => $reference_number,
            'trans_status' => 'Successful',
            'trans_status_description' => 'Successful',
            'swift_code' => '',
            'destination_bank_name' => '',
            'destination_bank_number' => '',
            'payment_status' => 'Successful',
            'recon_status' => 'Pending',
            'loan_id' => $loan_id,
        ]);
    }


    public function creditWithReference($credit_account_number,$credit_account_new_balance
        ,$debit_account_number,$credit_amount,$naration,$bank_reference_number){

        $reference_number=time();
        //DEBIT RECORD MEMBER
        general_ledger::create([
            'record_on_account_number' => $credit_account_number,
            'record_on_account_number_balance' => $credit_account_new_balance,
            'sender_branch_id' =>auth()->user()->branch,
            'branch_id' => auth()->user()->branch,
            'beneficiary_branch_id' => 1,
            'sender_product_id' => '23',
            'sender_sub_product_id' =>'34',
            'beneficiary_product_id' => '111',
            'beneficiary_sub_product_id' => '1111',
            'sender_id' => '999999',
            'beneficiary_id' =>12,
            'sender_name' => 'Organization',
            'beneficiary_name' => '1234',
            'sender_account_number' => $debit_account_number,
            'beneficiary_account_number' => $credit_account_number,
            'transaction_type' => 'IFT',
            'sender_account_currency_type' => 'TZS',
            'beneficiary_account_currency_type' => 'TZS',
            'narration' => $naration,
            'credit' => $credit_amount,
            'debit' => 0,
            'reference_number' => $reference_number,
            'trans_status' => 'Successful',
            'trans_status_description' => 'Successful',
            'swift_code' => '',
            'destination_bank_name' => '',
            'destination_bank_number' => '',
            'payment_status' => 'Successful',
            'recon_status' => 'Pending',
            'bank_reference_number'=>$bank_reference_number,
        ]);
    }



    public function  debit($debit_account_number,$debit_account_new_balance,
                           $credit_account_number,$debit_amount,$narations,$loan_id){


        $reference_number=time();
        //DEBIT RECORD MEMBER
        general_ledger::create([
            'record_on_account_number' => $debit_account_number,
            'record_on_account_number_balance' => $debit_account_new_balance,
            'sender_branch_id' =>auth()->user()->branch,
            'beneficiary_branch_id' => auth()->user()->institution_id,
            'sender_product_id' => '34',
            'sender_sub_product_id' => '45',
            'branch_id' => auth()->user()->branch,
            'beneficiary_product_id' => '111',
            'beneficiary_sub_product_id' => '111',
            'sender_id' => '999999',
            'beneficiary_id' =>'24',
            'sender_name' => 'Organization',
            'beneficiary_name' => '34',
            'sender_account_number' =>$debit_account_number ,
            'beneficiary_account_number' => $credit_account_number,
            'transaction_type' => 'IFT',
            'sender_account_currency_type' => 'TZS',
            'beneficiary_account_currency_type' => 'TZS',
            'narration' =>$narations,
            'credit' => 0,
            'debit' => $debit_amount,
            'reference_number' => $reference_number,
            'trans_status' => 'Successful',
            'trans_status_description' => 'Successful',
            'swift_code' => '',
            'destination_bank_name' => '',
            'destination_bank_number' => '',
            'payment_status' => 'Successful',
            'recon_status' => 'Pending',
            'loan_id' => $loan_id,
        ]);

    }
    public function  withBankReferenceNumber($debit_account_number,$debit_account_new_balance,
                           $credit_account_number,$debit_amount,$narations,$bank_reference_number){


        $reference_number=time();
        //DEBIT RECORD MEMBER
        general_ledger::create([
            'record_on_account_number' => $debit_account_number,
            'record_on_account_number_balance' => $debit_account_new_balance,
            'sender_branch_id' =>auth()->user()->branch,
            'beneficiary_branch_id' => auth()->user()->institution_id,
            'sender_product_id' => '34',
            'sender_sub_product_id' => '45',
            'branch_id' => auth()->user()->branch,
            'beneficiary_product_id' => '111',
            'beneficiary_sub_product_id' => '111',
            'sender_id' => '999999',
            'beneficiary_id' =>'24',
            'sender_name' => 'Organization',
            'beneficiary_name' => '34',
            'sender_account_number' =>$debit_account_number ,
            'beneficiary_account_number' => $credit_account_number,
            'transaction_type' => 'IFT',
            'sender_account_currency_type' => 'TZS',
            'beneficiary_account_currency_type' => 'TZS',
            'narration' =>$narations,
            'credit' => 0,
            'debit' => $debit_amount,
            'reference_number' => $reference_number,
            'trans_status' => 'Successful',
            'trans_status_description' => 'Successful',
            'swift_code' => '',
            'destination_bank_name' => '',
            'destination_bank_number' => '',
            'payment_status' => 'Successful',
            'recon_status' => 'Pending',
            'bank_reference_number'=>$bank_reference_number,
        ]);

    }
}
