<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\DailySalesReportDataTable;
use App\DataTables\MonthlySalesReportDataTable;

class SalesReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /* public function index(DailySalesReportDataTable $dataTable)
    {
        return $dataTable->render('reports.sales.index');

        #return view('reports.sales.index', compact('dataTable')); #$dataTable->render('reports.sales.index'));
    } */

    public function index(DailySalesReportDataTable $dailySalesReportDataTable, MonthlySalesReportDataTable $monthlySalesReportDataTable)
    {
        return view('reports.sales.index', [
            'dailySalesReportDataTable' => $dailySalesReportDataTable->html(),
            'monthlySalesReportDataTable' => $monthlySalesReportDataTable->html()
        ]);
    }

    public function getDaily(DailySalesReportDataTable $dailySalesReportDataTable)
    {
        return $dailySalesReportDataTable->render('reports.sales.index');
    }


    public function getMonthly(MonthlySalesReportDataTable $monthlySalesReportDataTable)
    {
        return $monthlySalesReportDataTable->render('reports.sales.index');
    }
}
