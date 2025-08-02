<?php

namespace App\Http\Livewire\Reconciliation\Crdb;

use App\Models\CrdbNonMatching;
use App\Models\NmbNonMatching;
use App\Models\UchumiNonMatching;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Traits\ComponentUtilities;
use Rappasoft\LaravelLivewireTables\Traits\WithBulkActions;
use Rappasoft\LaravelLivewireTables\Traits\WithColumns;
use Rappasoft\LaravelLivewireTables\Traits\WithColumnSelect;
use Rappasoft\LaravelLivewireTables\Traits\WithData;
use Rappasoft\LaravelLivewireTables\Traits\WithDebugging;
use Rappasoft\LaravelLivewireTables\Traits\WithEvents;
use Rappasoft\LaravelLivewireTables\Traits\WithFilters;
use Rappasoft\LaravelLivewireTables\Traits\WithFooter;
use Rappasoft\LaravelLivewireTables\Traits\WithPagination;
use Rappasoft\LaravelLivewireTables\Traits\WithRefresh;
use Rappasoft\LaravelLivewireTables\Traits\WithReordering;
use Rappasoft\LaravelLivewireTables\Traits\WithSearch;
use Rappasoft\LaravelLivewireTables\Traits\WithSecondaryHeader;
use Rappasoft\LaravelLivewireTables\Traits\WithSorting;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Session;

class Nonmatching extends DataTableComponent
{
    use ComponentUtilities,
        WithBulkActions,
        WithColumns,
        WithColumnSelect,
        WithData,
        WithDebugging,
        WithEvents,
        WithFilters,
        WithFooter,
        WithPagination,
        WithRefresh,
        WithReordering,
        WithSearch,
        WithSecondaryHeader,
        WithSorting;

    public $defaultView = true;

    public $showOrderDetails = false;

    public $orderToView = '';

    protected $listeners = ['refreshTables' => '$refresh'];

    public function boot(): void
    {
        // $this->builder =$this->Builder();
        $this->setBuilder($this->builder());

        $this->{$this->tableName} = [
            'sorts' => $this->{$this->tableName}['sorts'] ?? [],
            'filters' => $this->{$this->tableName}['filters'] ?? [],
        ];

        // Set the filter defaults based on the filter type
        $this->setFilterDefaults();

        $this->configure();
        $this->setTheme();

        $this->setColumns();

        // Make sure a primary key is set
        if (! $this->hasPrimaryKey()) {
            throw new DataTableConfigurationException('You must set a primary key using setPrimaryKey in the configure method.');
        }

    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        return view('livewire.reconciliation.cb.test')->with([
            'columns' => $this->getColumns(),
            'rows' => $this->getRows(),
        ]);
    }

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {

        $this->ordernumber = Session::get('orderNumber');
        if (Session::get('typeOfTransfer') == 'CRDB') {
            $transactions = CrdbNonMatching::where('order_number', $this->ordernumber);
        } elseif (Session::get('typeOfTransfer') == 'NMB') {
            $transactions = NmbNonMatching::where('order_number', $this->ordernumber);
        } elseif (Session::get('typeOfTransfer') == 'UCHUMI') {
            $transactions = UchumiNonMatching::where('order_number', $this->ordernumber);
        } else {
            $transactions = CrdbNonMatching::where('order_number', $this->ordernumber);
        }

        if ($transactions->first()) {
            $this->showSendButton = true;
        }

        return $transactions;

    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            // ->setReorderEnabled()
            ->setSingleSortingDisabled()
            ->setHideReorderColumnUnlessReorderingEnabled()
            ->setFilterLayoutSlideDown()
            // ->setRememberColumnSelectionDisabled()
            ->setSecondaryHeaderTrAttributes(function ($rows) {
                return ['class' => 'bg-gray-100'];
            })
            ->setSecondaryHeaderTdAttributes(function (Column $column, $rows) {
                if ($column->isField('id')) {
                    return ['class' => 'text-red-500'];
                }

                return ['default' => true];
            })
            ->setFooterTrAttributes(function ($rows) {
                return ['class' => 'bg-gray-100'];
            })
            ->setFooterTdAttributes(function (Column $column, $rows) {
                if ($column->isField('name')) {
                    return ['class' => 'text-green-500'];
                }

                return ['default' => true];
            })
            ->setUseHeaderAsFooterEnabled()
            ->setHideBulkActionsWhenEmptyEnabled()
            ->setColumnSelectEnabled();
    }

    public function columns(): array
    {
        return [
            Column::make('No', 'id'),
            Column::make('recon id', 'order_number')
                ->sortable()
                ->searchable(),
            Column::make('value date', 'value_date')
                ->sortable()
                ->searchable(),
            Column::make('reference', 'reference_number')
                ->sortable()
                ->searchable(),
            Column::make('credit', 'credit')
                ->sortable()
                ->searchable(),
            Column::make('debit', 'debit')
                ->sortable()
                ->searchable(),
            Column::make('description', 'details')
                ->sortable(),
            Column::make('recon date', 'created_at')
                ->sortable()
                ->searchable(),
        ];
    }
}
