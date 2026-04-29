<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\OrderItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\StockHistory;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.report');
    }

    //  Stock Report
    public function stockReport(Request $request)
    {
        $mode = $request->mode ?? 'download';

        $products = Product::select('name', 'product_code', 'stock_quantity')
            ->orderBy('stock_quantity', 'desc')
            ->get();

        $pdf = Pdf::loadView('admin.reports.stock', compact('products'))
            ->setPaper('A4', 'portrait');

        $fileName = 'stock_report_' . now()->format('Y-m-d') . '.pdf';

        if ($mode === 'preview') {
            return $pdf->stream($fileName);
        }

        return $pdf->download($fileName);
    }


    //  Sell Report
    public function sellReport(Request $request)
    {
        $mode  = $request->mode ?? 'download';
        $range = $request->range ?? 'today';

        if ($range === 'today') {
            $from = now()->startOfDay();
            $to   = now()->endOfDay();
        } elseif ($range === 'week') {
            $from = now()->subDays(6)->startOfDay();
            $to   = now()->endOfDay();
        } else {
            $from = now()->subDays(29)->startOfDay();
            $to   = now()->endOfDay();
        }

        $items = OrderItem::with('product')
            ->whereBetween('created_at', [$from, $to])
            ->get()
            ->filter(fn($item) => $item->product !== null)
            ->groupBy(function ($item) {
                return $item->created_at->format('Y-m-d') . '_' . $item->product_id;
            })
            ->map(function ($group) {
                $product = $group->first()->product;
                $date    = $group->first()->created_at;

                return [
                    'date'          => $date->format('Y-m-d'),
                    'day'           => $date->format('D'),
                    'product_code'  => $product->product_code,
                    'product_name'  => $product->name,
                    'total_qty'     => $group->sum('quantity'),
                    'total_amount'  => $group->sum('total_price'),
                ];
            });

        $totalSellAmount = $items->sum('total_amount');

        $pdf = Pdf::loadView('admin.reports.sell', compact('items', 'range', 'totalSellAmount'))
            ->setPaper('A4', 'portrait');

        $fileName = 'sell_report_' . $range . '_' . now()->format('Y-m-d') . '.pdf';

        if ($mode === 'preview') {
            return $pdf->stream($fileName);
        }

        return $pdf->download($fileName);
    }

    public function restockReport(Request $request)
    {
        $mode  = $request->mode ?? 'download';
        $range = $request->range ?? 'today';

        if ($range === 'today') {
            $from = now()->startOfDay();
            $to   = now()->endOfDay();
        } elseif ($range === 'week') {
            $from = now()->subDays(6)->startOfDay();
            $to   = now()->endOfDay();
        } else {
            $from = now()->subDays(29)->startOfDay();
            $to   = now()->endOfDay();
        }

        // Stock History Query
        $items = StockHistory::with('product')
            ->whereBetween('created_at', [$from, $to])
            ->get()
            ->filter(fn($item) => $item->product !== null)
            ->groupBy(function ($item) {
                return $item->created_at->format('Y-m-d') . '_' . $item->product_id;
            })
            ->map(function ($group) {
                $product = $group->first()->product;
                $date    = $group->first()->created_at;

                return [
                    'date'           => $date->format('Y-m-d'),
                    'day'            => $date->format('D'),
                    'product_code'   => $product->product_code,
                    'product_name'   => $product->name,
                    'total_added'    => $group->sum('quantity_added'),
                    'opening_stock'  => $group->first()->old_stock,
                    'closing_stock'  => $group->last()->new_stock,
                ];
            });

        $totalRestockQty = $items->sum('total_added');

        // PDF Generate
        $pdf = Pdf::loadView('admin.reports.restock', compact(
            'items',
            'range',
            'totalRestockQty'
        ))->setPaper('A4', 'portrait');

        $fileName = 'restock_report_' . $range . '_' . now()->format('Y-m-d') . '.pdf';

        if ($mode === 'preview') {
            return $pdf->stream($fileName);
        }

        return $pdf->download($fileName);
    }
}
