<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\PaymentsReportDataTable;

use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Database\Query\Builder;

class PaymentsReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaymentsReportDataTable $dataTable)
    {
        return $dataTable->render('reports.payments.index');
        /* $payments = DB::table('payments')
                    ->where('host_id', auth()->user()->host_id)
                    ->get();
        return $payments; */
    }

}
