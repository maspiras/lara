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

class ReservationsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'reservations.action')
//            ->editColumn('full name', 'Full Name')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Reservation $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->columns($this->getColumns())
            //->columns["Marks"].ColumnName = "SubjectMarks";
            //->editColumn('fullname', 'Full Name')
            ->minifiedAjax()
            //->addAction(['width' => '80px'])
            ->parameters([
             //   'dom' => 'Bfrtip',
                //'buttons' => ['export', 'print', 'paging', 'reset', 'reload'],
            ]);
        /* return $this->builder()                    
                    ->setTableId('reservations-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]); */
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        /*return [
            
            Column::make('id'),
            Column::make('fullname'),
            Column::make('checkin'),
            Column::make('checkout'),
            Column::make('booking_status_id'),
            Column::computed('action')
                   ->exportable(true)
                  ->printable(true) 
                  ->addClass('text-center'),
        ]; */

        /* return [
            ['id' => 'Ref #', 'fullname' => 'Full Name', 'checkin' => 'Checkin', 'checkout' => 'Checkout', 'booking_status_id' => 'Status']
        ]; */
        return [
            ['title'=>'Ref','data'=>"id"],
            ['title'=>'Full Name','data'=>"fullname"],
            ['title'=>'Checkin','data'=>"checkin"],
            ['title'=>'Checkout','data'=>"checkout"],
            ['title'=>'Status','data'=>"booking_status_id"],
            Column::computed('action')->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Reservations_' . date('YmdHis');
    }
}
