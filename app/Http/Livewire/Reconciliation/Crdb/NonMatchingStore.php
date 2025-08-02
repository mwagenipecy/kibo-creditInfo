<?php

namespace App\Http\Livewire\Reconciliation\Crdb;

use App\Models\crdbtransactionsnonmatchingstore;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Session;
use JetBrains\PhpStorm\NoReturn;
use Livewire\WithFileUploads;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Traits\WithBulkActions;
use Rappasoft\LaravelLivewireTables\Traits\WithColumns;
use Rappasoft\LaravelLivewireTables\Traits\WithColumnSelect;
use Rappasoft\LaravelLivewireTables\Traits\WithData;
use Rappasoft\LaravelLivewireTables\Traits\WithDebugging;
use Rappasoft\LaravelLivewireTables\Traits\WithFilters;
use Rappasoft\LaravelLivewireTables\Traits\WithFooter;
use Rappasoft\LaravelLivewireTables\Traits\WithPagination;
use Rappasoft\LaravelLivewireTables\Traits\WithRefresh;
use Rappasoft\LaravelLivewireTables\Traits\WithReordering;
use Rappasoft\LaravelLivewireTables\Traits\WithSearch;
use Rappasoft\LaravelLivewireTables\Traits\WithSecondaryHeader;
use Rappasoft\LaravelLivewireTables\Traits\WithSorting;
use Rappasoft\LaravelLivewireTables\Views\Column;

// use Vtiful\Kernel\Excel;

class NonMatchingStore extends DataTableComponent
{
    use WithBulkActions,
        WithColumns,
        WithColumnSelect,
        WithData,
        WithDebugging,
        WithFilters,
        WithFooter,
        WithPagination,
        WithRefresh,
        WithReordering,
        WithSearch,
        WithSecondaryHeader,
        WithSorting;
    use WithFileUploads;

    public $ordernumber = '';

    protected $listeners = ['refreshTables' => '$refresh'];

    public function render(): Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $this->ordernumber = Session::get('orderNumber');

        return view('livewire.reconciliation.crdb.non-matching-store')->with([
            'columns' => $this->getColumns(),
            'rows' => $this->getRows(),
        ]);

    }

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        $this->ordernumber = Session::get('orderNumber');
        $transactions = crdbtransactionsnonmatchingstore::where('order_number', $this->ordernumber);
        // dd($transactions->get());

        return $transactions;
    }

    /**
     * @throws DataTableConfigurationException
     */
    #[NoReturn]
    public function boot(): void
    {

        // $this->builder =$this->Builder();
        $this->setBuilder($this->builder());

        //        $this->{$this->tableName} = [
        //            'sorts' => $this->{$this->tableName}['sorts'] ?? [],
        //            'filters' => $this->{$this->tableName}['filters'] ?? [],
        //        ];

        // Set the user defined columns to work with
        $this->setColumns();

        // Call the child configuration, if any
        $this->configure();

        // Make sure a primary key is set
        if (! $this->hasPrimaryKey()) {
            throw new DataTableConfigurationException('You must set a primary key using setPrimaryKey in the configure method.');
        }

        // Set the filter defaults based on the filter type
        // $this->setFilterDefaults();

    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            // ->setReorderEnabled()
            ->setSingleSortingDisabled()
            ->setHideReorderColumnUnlessReorderingEnabled()
            ->setFilterLayoutSlideDown()
            ->setRememberColumnSelectionDisabled()
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
            ->setHideBulkActionsWhenEmptyEnabled();
    }

    // BULK ACTIONS
    public function paySelected()
    {
        foreach ($this->getSelected() as $item) {
            // These are strings since they came from an HTML element
        }
        $this->clearSelected();
    }

    public function columns(): array
    {

        $hideColumn = true;

        return [
            Column::make('id', 'id')
                ->hideIf(true),
            Column::make('select', 'selected')
                ->format(function ($value, $row, Column $column) {

                    $this->theselected = $row->id;

                    if ($this->ProcessStatus === 'pending') {
                        return view('livewire.payments.checkbox-disabled')->withValue($value);
                    }
                    if ($this->ProcessStatus === 'approved') {
                        return view('livewire.payments.checkbox-disabled')->withValue($value);
                    }

                    return view('livewire.payments.checkbox')->withValue($value);
                })
                ->hideIf(true),
            Column::make('Reference number', 'reference_number')
                ->sortable()
                ->searchable(),
            Column::make('Value Date', 'value_date')
                ->sortable()
                ->searchable(),
            Column::make('debit', 'debit')
                ->sortable()
                ->searchable(),
            Column::make('credit', 'credit')
                ->sortable()
                ->searchable(),
            Column::make('Description', 'details')
                ->sortable()
                ->searchable(),
            Column::make('Resolution', 'payment_status')
                ->sortable()
                ->searchable(),
            Column::make('Action', 'id')
                ->format(function ($value, $row, Column $column) {

                    $this->theselected = $row->id;
                    if ($row->payment_status == 'Pending') {
                        return view('livewire.cb.action')->withValue($value);
                    } else {
                        return null;
                    }

                }),

        ];
    }

    public function resolve($value)
    {

        crdbtransactionsnonmatchingstore::where('id', $value)->update(['payment_status' => 'Resolved']);
        $this->emit('refreshSideInfo');
    }
}
