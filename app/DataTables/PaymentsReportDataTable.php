<?php

namespace App\DataTables;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Database\Query\Builder;

class PaymentsReportDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            #->addColumn('action', 'paymentsreport.action')
            ->editColumn('added_on', function($row){                
                return date('M d, Y', strtotime($row->added_on));                
            })
            ->editColumn('checkin', function($row){                
                return date('M d, Y', strtotime($row->checkin));                
            })
            ->editColumn('checkout', function($row){                
                return date('M d, Y', strtotime($row->checkout));                
            })
            ->editColumn('amount', function($row){                
                return number_format($row->amount, 2, '.', ',');
            }) 
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Payment $model): QueryBuilder
    #public function query(): QueryBuilder
    {
        return $model->newQuery()
        ->select('reservations.fullname', 'reservations.checkin', 'reservations.checkout', 'payments.reservation_id', 'payments.amount', 'payments.added_on')
        ->join('reservations', 'reservations.id', '=', 'payments.reservation_id')
        ->where('payments.host_id', auth()->user()->host_id);
        
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('paymentsreport-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->dom('lBfrtip')
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('copy'),
                        Button::make('excel'),                        
                        Button::make('pdf'),
                        Button::make('print')->className('btn btn-info'),
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            /* Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'), */
            
            Column::make("reservation_id")->title('Reservation ID'), 
            Column::make("fullname")->title('Full name'),                 
            Column::make("checkin")->title('Checkin'),    
            Column::make("checkout")->title('Checkout'),    
            Column::make("added_on")->title('Date'),                     
            Column::make('amount'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PaymentsReport_' . date('YmdHis');
    }
}
