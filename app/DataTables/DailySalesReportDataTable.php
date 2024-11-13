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



class DailySalesReportDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))           
           ->editColumn('added_on', function($row){                
                return date('M d, Y', strtotime($row->added_on));
                #return Carbon::parse($row->newdate)->format('M d, Y');            
            })
            ->filterColumn('added_on', function($query, $keyword) {
                $sql = "added_on  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
                return $query;
            })
            ->editColumn('amount', function($row){                
                return number_format($row->amount, 2, '.', ',');
            })            
            ->setRowId('added_on');
            
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Payment $model): QueryBuilder
    {
        #return $model->newQuery();
        
        return $model->select('added_on', DB::raw("DATE_FORMAT(added_on, '%Y-%m-%d') as newdate"), DB::raw("SUM(amount) as amount")  )                
        ->where('host_id', auth()->user()->host_id)
        ->groupBy('newdate');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('dailysalesreport-table')
                    ->columns($this->getColumns())
                    //->minifiedAjax()
                    ->minifiedAjax(route('reports.sales.daily'))
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
            
            Column::make("added_on")->title('Date'),   
            //['title'=>'Date','data'=>"added_on"],         
            Column::make('amount'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'DailySalesReport_' . date('YmdHis');
    }
}
