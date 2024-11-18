<?php

namespace App\DataTables;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ReservationsReportDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->editColumn('checkin', function($row){                
            return date('M d, Y h:i a', strtotime($row->checkin));
        })
        ->editColumn('checkout', function($row){                
            return date('M d, Y h:i a', strtotime($row->checkout));
        })
        ->editColumn('booking_status_id', function($row){  
            $d = '';
            if(empty($row->booking_status_id) || $row->booking_status_id == ''){
                $d = 'Pencil';
            } else          if($row->booking_status_id == 1){
                $d = 'Confirmed';
            }else{
                $d = 'Cancelled';
            }
            return $d;
        })
        ->editColumn('payment_status_id', function($row){                
            $p = '';
            if(empty($row->payment_status_id) || $row->payment_status_id == '' || $row->payment_status_id == 1){
                $p = 'No payment';
            }elseif($row->payment_status_id == 2){
                $p = 'Prepayment paid';
            }else{
                $p = 'Fully paid';
            }
            return $p;
        })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Reservation $model): QueryBuilder
    {
        #return $model->newQuery();
        return $model->where('host_id', auth()->user()->host_id)
        ->orderBy('checkin');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('reservationsreport-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lBfrtip')
                    //->orderBy(0)                    
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('copy'),
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),                     
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        /* return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('fullname'),
            Column::make('checkin'),
            Column::make('checkout'),
        ]; */

        return [
            ['title'=>'Ref #','data'=>"ref_number"],
            ['title'=>'Full Name','data'=>"fullname"],
            ['title'=>'Checkin','data'=>"checkin"],
            ['title'=>'Checkout','data'=>"checkout"],
            ['title'=>'Booking Status','data'=>"booking_status_id"],
            ['title'=>'Payment Status','data'=>"payment_status_id"],
            #Column::computed('action')->addClass('text-center'),
            #Column::computed('action')->exportable(false)->printable(false)->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ReservationsReport_' . date('YmdHis');
    }
}
