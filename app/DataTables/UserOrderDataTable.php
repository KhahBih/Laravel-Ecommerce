<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserOrderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('id', function(){
            static $index = 0;
            return ++$index;
        })
        ->addColumn('action', function($query){
            $editBtn = "<a href='".route('vendor.order.show', $query->id)."' class='btn btn-primary'><i class='far fa-eye'></i></a>";
            return $editBtn;
        })
        ->addColumn('customer', function($query){
            return $query->user->name;
        })
        ->addColumn('amount', function($query){
            return $query->amount.$query->currency_icon;
        })
        ->addColumn('payment_status', function($query){
            if($query->payment_status == 1){
                return "<span class='badge bg-success' style='color: white!important'>Complete</span>";
            }else{
                return "<span class='badge bg-danger' style='color: white!important'>Pending</span>";
            }
        })
        ->addColumn('date', function($query){
            return date('Y-m-d', strtotime($query->created_at));
        })
        ->addColumn('order_status', function($query){
            switch ($query->order_status) {
                case 'pending':
                    return "<span class='badge bg-warning' style='color: white!important'>Pending</span>";
                    break;
                case 'processed_and_ready_to_ship':
                    return "<span class='badge bg-info' style='color: white!important'>Processed</span>";
                    break;
                case 'dropped_off':
                    return "<span class='badge bg-info' style='color: white!important'>Dropped off</span>";
                    break;
                case 'shipped':
                    return "<span class='badge bg-info' style='color: white!important'>Shipped</span>";
                    break;
                case 'out_for_delivery':
                    return "<span class='badge bg-primary' style='color: white!important'>Out for delivery</span>";
                    break;
                case 'delivered':
                    return "<span class='badge bg-success' style='color: white!important'>Delivered</span>";
                    break;
                case 'canceled':
                    return "<span class='badge bg-danger' style='color: white!important'>Canceled</span>";
                    break;
                default:
                    # code...
                    break;
            }
        })
        ->rawColumns(['action', 'order_status', 'payment_status'])
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        return $model->where('user_id', Auth::user()->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendororder-table')
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
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('invoice_id')->width(120),
            Column::make('customer'),
            Column::make('date')->width(120),
            Column::make('product_qty'),
            Column::make('amount'),
            Column::make('order_status'),
            Column::make('payment_status'),
            Column::make('payment_method')->width(70),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(180)
                  ->addClass('text-center')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'UserOrder_' . date('YmdHis');
    }
}
