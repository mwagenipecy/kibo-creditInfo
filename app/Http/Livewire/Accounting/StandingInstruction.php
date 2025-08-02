<?php

namespace App\Http\Livewire\Accounting;

use App\Models\approvals;
use Livewire\Component;

class StandingInstruction extends Component
{
    public $tab_id = 1;

    public $new_stannding_order = false;

    public $source_account_number;

    public $destination_type;

    public $amount;

    public $destination_account_number;

    public $action_date;

    public $end_date;

    public $description;

    protected $rules = [
        'amount' => 'required',
        'source_account_number' => 'required',
        'destination_account_number' => 'required',
        'end_date' => 'required',
        'action_date' => 'required',
    ];

    public function menuItemClicked()
    {
        if ($this->new_stannding_order == false) {
            $this->new_stannding_order = true;
        }
    }

    public function save()
    {
        $this->validate();

        $id = StandingInstruction::create([
            'amount' => $this->amount,
            'destination_account_number' => $this->destination_account_number,
            'source_account_number' => $this->source_account_number,
            'action_date' => $this->action_date,
            'status' => 'PENDING',
            'end_date' => $this->end_date,
        ])->id;

        $approval = new approvals;
        $approval->sendApproval($id, 'createStandingOrder', 'has created standing order', 'new standing order', '12', '');

        session()->flash('message', 'successfully saved');
        $this->emit('refresh');

    }

    public function render()
    {
        return view('livewire.accounting.standing-instruction');
    }
}
