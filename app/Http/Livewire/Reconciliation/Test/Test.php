<?php

namespace App\Http\Livewire\Test;

use App\Exports\ExportTransactions;
use App\Exports\ExportTransactionsAll;
use App\Models\Orders;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\DB;
// use Vtiful\Kernel\Excel;

use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Test extends Component
{
    public $css;

    public $oneIsSetClicked = true;

    public $twoIsSetClicked = false;

    public $threeIsSetClicked = false;

    public $ordernumber = '';

    public $ordernumberissaved = false;

    public $selectedDestination = '';

    public $amountOfcashbooknonmatchingstore = '';

    public $amountOfcashbooknonmatchingstoreDisplay = '';

    public $selectedBank = '';

    public $recipientName = '';

    public $sourceAccount = '';

    public $description = '';

    public $amount = '';

    public $accountNumber = '';

    public $fromDB = false;

    public $showSaveButton = false;

    public $xx = 'Select';

    public $accounts;

    public $selectedMno = 'Tigo';

    public $mobileNumber = '';

    public $monthOnFocus = 'April';

    public $yearOnFocus = '2022';

    public $theselected;

    public $permissionId = [];

    public $Amountpending;

    public $level = [];

    public $ProcessExists;

    public $ProcessStatus;

    public $ProcessPaymentStatus;

    public $excelFile;

    public $orders;

    public $CurrentOrder;

    public $modal = false;

    public $deleteOrderModal = false;

    public $orderToDeleteId = '';

    public $entryToDeleteId = '';

    public $deleteEntryModal = '';

    public $order_status = '';

    public $exceptions = false;

    public $rejectionReason = '';

    public mixed $reasonError = '';

    public $prepareForRejection = false;

    public $newOrderNumber = '';

    public $session_id = '';

    public $third_part = '';

    public $created_at = '';

    public $start_date = '';

    public $end_date = '';

    protected $listeners = ['refreshSideInfo' => '$refresh'];

    public function preReject()
    {
        Session::put('orderNumber', $this->ordernumber);
        $this->prepareForRejection = true;
    }

    public function showEditModal($value)
    {
        // Session::get('orderNumber')
        Session::put('editTransactionID', $value);
        $this->modal = true;
    }

    public function confirmDeleteOrder($value)
    {
        $this->orderToDeleteId = $value;
        // Session::get('orderNumber')
        Session::put('deleteOrderID', $value);
        $this->deleteOrderModal = true;
    }

    public function confirmDeleteEntry($value)
    {

        $this->entryToDeleteId = $value;
        // Session::get('orderNumber')
        Session::put('deleteTransactionID', $value);
        $this->deleteEntryModal = true;
    }

    public function deleteOrderConfirmed()
    {

        $res = Orders::where('id', $this->orderToDeleteId)->delete();
        $this->deleteOrderModal = false;
    }

    public function closeDeleteOrderModal()
    {
        $this->deleteOrderModal = false;
    }

    public function closeDeleteEntryModal()
    {
        $this->deleteEntryModal = false;
    }

    public function closeEditEntryModal()
    {

        $this->modal = false;
    }

    protected $rules = [
        'expensename' => 'required|min:3',
        'amount' => 'required|min:3',
    ];

    public function render(): Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        $this->orders = DB::table('reco_sessions')->orderBy('id', 'DESC')->get();

        $this->CurrentOrder = DB::table('reco_sessions')
            ->where('session_id', Session::get('orderNumber'))
            ->get();
        foreach ($this->CurrentOrder as $TheOrder) {
            $this->session_id = $TheOrder->session_id;
            $this->third_part = $TheOrder->third_part;
            $this->created_at = $TheOrder->created_at;
            $this->start_date = $TheOrder->start_date;
            $this->end_date = $TheOrder->end_date;
        }
        // Session::put('orderNumber', $this->ordernumber);

        return view('livewire.test.test');

    }

    public function getOrderDetails($OrderId)
    {

        $order_number_new = '';
        $currentOrder = DB::table('reco_sessions')->where('id', $OrderId)->get();
        foreach ($currentOrder as $TheOrder) {
            $order_number_new = $TheOrder->session_id;
        }
        $this->ordernumber = $order_number_new;
        // $this->ordernumber->reflesh();
        Session::put('orderNumber', $this->ordernumber);

        $this->emit('refreshTables');
        // return redirect(request()->header('Referer'));
    }

    public function exportUsers()
    {
        Session::put('committed', true);
        Session::put('fileToDownload', 'CB');

        return Excel::download(new ExportTransactions, 'Cashbook_non_matched_transactions.xlsx');
    }

    public function exportUsersx()
    {
        Session::put('committed', true);
        Session::put('fileToDownload', $this->third_part);

        return Excel::download(new ExportTransactions, $this->third_part.'_non_matched_transactions.xlsx');
    }

    public function exportUsersAll()
    {
        Session::put('committed', true);
        Session::put('fileToDownload', 'CB');

        return Excel::download(new ExportTransactionsAll, 'Cashbook_non_matched_transactions.xlsx');
    }

    public function exportUsersxAll()
    {
        Session::put('committed', true);
        Session::put('fileToDownload', 'CRDB');

        return Excel::download(new ExportTransactionsAll, 'CRDB_non_matched_transactions.xlsx');
    }
}
