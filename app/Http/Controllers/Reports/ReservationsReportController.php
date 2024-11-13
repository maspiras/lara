<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\ReservationsReportDataTable;

class ReservationsReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ReservationsReportDataTable $dataTable)
    {
        return $dataTable->render('reports.reservations.index');
    }

   
}
