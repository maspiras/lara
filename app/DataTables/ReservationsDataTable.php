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
//use App\Models\User;
use Carbon\Carbon;

class ReservationsDataTable extends DataTable
{
    #protected $exportColumns = array(['fullname', 'checkin']);
   
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        
            #->addColumn('action', 'reservations.datatables_actions')
            //->addIndexColumn() ->addColumn('id', function($row) { return $row->id; })
            ->addColumn('action', function ($reservation) {
                return view('reservations.datatables_actions', compact('reservation'));
            })
            ->editColumn('checkin', function($row){                
                return date('M d, Y', strtotime($row->checkin));
            })
            ->editColumn('checkout', function($row){                
                return date('M d, Y', strtotime($row->checkout));
            })
            /*
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
            }) */
            ->editColumn('payment_status_id', function($row){                
                $p = '';
                if(empty($row->payment_status_id) || $row->payment_status_id == '' || $row->payment_status_id == 1){
                    $p = 'No payment';
                }elseif($row->payment_status_id == 2){
                    $p = 'Down payment';
                }else{
                    $p = 'Fully paid';
                }
                return $p;
            })
            /* ->editColumn('action', function($row){
                $actionBtn = '<a href="'.$row['id'].'" class="edit btn btn-success btn-sm">Edit</a> <a href="'.$row['id'].'" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })  */
            /* ->addAction(['width' => '120px', 'printable' => true])
            ->addColumn('action', 'reservations.datatables_actions')
            ->editColumn('action', function (Reservation $reservation) {
                return view('reservations.datatables_actions');
            })
            ->editColumn( 'action', function( Reservation $model ){
                return view( 'reservations.datatables_actions', ['model' => $model] );
           })
            ->rawColumns(['action']) */
//            ->editColumn('full name', 'Full Name')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Reservation $model): QueryBuilder
    {
        $last_month = Carbon::create(date('Y-m-d', strtotime("-1 month")))->startOfMonth();
        #$last_month = Carbon::today()->subDays(30);
        #return $model->newQuery()
        
        
        return $model
        #->where('checkin', '>=', now()->subDays(7))
        ->where('checkin', '>=', now())
        ->where('host_id', auth()->user()->host_id)
        ->orderBy('checkin');
        #->where('created_at', '>=', $last_month );
        #->whereDate('created_at','>=', $last_month);
        #return $model->newQuery();
        /*return $model->newQuery()
        ->with('reservation')
        ->select([
            'id', 'fullname', 'checkin', 'checkout', 'booking_status_id', 'payment_status_id'
        ]); */
        /*return $model->newQuery()->join('reservations', 'reservations.host_id', '=', 'users.host_id')
    ->select(['reservations.id as id', 'reservations.fullname as fullname', 'reservations.checkin', 'reservations.checkout', 'reservations.booking_status_id', 'reservations.payment_status_id'])
    ->orderBy('reservations.id', 'desc')
    ->latest('reservations.created_at'); */

        /* return $model->newQuery()->with([
            'reservation.id', 'reservation.fullname', 'reservation.checkin', 'reservation.checkout', 'reservation.booking_status_id', 'reservation.payment_status_id'
        ]); */
               //->select('reservations.id', 'reservations.fullname', 'reservations.checkin', 'reservations.checkout', 'reservations.booking_status_id', 'reservations.payment_status_id');
        #return $model->newQuery()->where('host_id', $this->host_id);
        /* return $model->newQuery()->with("product")
        ->where('product_orders.order_id', $this->id)
        ->select('product_orders.*')->orderBy('product_orders.id', 'desc')->paginate(11); */

        #return $model->newQuery()->orderBy('id', 'desc');
        /* return $model->newQuery()->with("product")
        ->where('product_orders.order_id', $this->id)
        ->select('product_orders.*')->orderBy('product_orders.id', 'desc'); */

        /* return $model->filterColumn('fullname', function($query, $keyword) {
            $sql = "CONCAT(users.first_name,'-',users.last_name)  like ?";
            $query->whereRaw($sql, ["%{$keyword}%"]);
        }) */
       
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        /* return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->addAction(['width' => '80px'])
            //->lengthMenu([ 10, 25, 50, 75, 100 ])            
            ->parameters([
                'dom' => 'lBfrtip',
                //'columns' => ':not(:last-child)',
                //'buttons' => ['export', 'print', 'paging', 'reset', 'reload'],
            ]); */
        return $this->builder()                    
                    ->setTableId('reservations-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lBfrtip')
                    ->orderBy(0)
                    ->parameters([
                    'processing' => true,
                'serverSide' => true,
                'deferRender' => true,
                
                //'responsive' => true,
                //'autoWidth' => false,
                //'stateSave' => true,
                //"ordering" => false,
                
                    ])
                    ->selectStyleSingle()
                 //   ->addAction(['width' => '120px', 'printable' => false])
     

                    ->buttons([
                        
                        Button::make('copy')->exportOptions([
                            'columns' => ':not(:last-child)', // My case exclude the last one
                            ]),
                        Button::make('excel') //->className('btn btn-info')
                        ->exportOptions([
                        'columns' => ':not(:last-child)', // My case exclude the last one
                        ]),
                        Button::make('csv')->exportOptions([
                            'columns' => ':not(:last-child)', // My case exclude the last one
                            ]),
                        Button::make('pdf')->exportOptions([
                            'columns' => ':not(:last-child)', // My case exclude the last one
                            ]),
                        Button::make('print')->exportOptions([
                            'columns' => ':not(:last-child)', // My case exclude the last one
                            ]),
                        
                        Button::make('colvis')->className('btn btn-info'),
                        
                        
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        
        /* $printColumns = [
            ['data' => 'fullname', 'title' => 'Name'],
            ['data' => 'checkin', 'title' => 'Registered Email'],
        ]; */
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
            ['title'=>'Ref #','data'=>"ref_number"],
            ['title'=>'Full Name','data'=>"fullname"],
            ['title'=>'Checkin','data'=>"checkin"],
            ['title'=>'Checkout','data'=>"checkout"],
          #  ['title'=>'Booking Status','data'=>"booking_status_id"],
            ['title'=>'Payment Status','data'=>"payment_status_id"],
            #Column::computed('action')->addClass('text-center'),
            Column::computed('action')->exportable(false)->printable(false)->addClass('text-center'),
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
