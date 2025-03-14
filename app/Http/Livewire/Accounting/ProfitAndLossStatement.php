<?php

namespace App\Http\Livewire\Accounting;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProfitAndLossStatement extends Component
{

    public function boot()
    {

        $user = auth()->user();
        $institution_id = $user->institution_id ;
        // Set the database connection based on the selected SACCO
        if ($institution_id) {
            $institution = \App\Models\institutions::find($institution_id);
            //dd($institution);
            if ($institution) {
                // Set the database connection
                Config::set('database.connections.institution', [
                    'driver' => 'mysql',
                    'host' => $institution->db_host,
                    'port' => $institution->db_port,
                    'database' => $institution->db_name,
                    'username' => $institution->db_username,
                    'password' => $institution->db_password,
                ]);
                DB::setDefaultConnection('institution');

            }
        }


    }

    public function render()
    {
        $this->income_accounts = DB::table('income_accounts')->get();
        $this->expense_accounts = DB::table('expense_accounts')->get();
        return view('livewire.accounting.profit-and-loss-statement');
    }
}
