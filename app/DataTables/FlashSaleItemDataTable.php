<?php

namespace App\DataTables;

use App\Models\FlashSaleItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FlashSaleItemDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('product', function($query){
                $fastEdit = "<a href='".route('admin.products.edit', $query->id)."'>{$query->product->name}</a>";
                return $fastEdit;
            })
            ->addColumn('action', function($query){
                $deleteBtn = "<a href='".route('admin.flash-sale.destroy', $query->id)."'
                class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";
                $editBtn = "<a href='".route('admin.flash-sale-item.edit', $query->id)."'
                class='btn btn-primary' style='margin-left:2px!important'><i class='far fa-edit'></i></a>";
                return $editBtn.$deleteBtn;
            })
            ->addColumn('show_at_home', function($query){
                $yes = '<i class="badge bg-success">Yes</i>';
                $no = '<i class="badge bg-danger">No</i>';
                if($query->show_at_home == 1){
                    return $yes;
                }else{
                    return $no;
                }
            })
            ->addColumn('status', function($query){
                $active = '<i class="badge bg-success">Active</i>';
                $inActive = '<i class="badge bg-danger">Inactive</i>';
                if($query->status == 1){
                    return $active;
                }else{
                    return $inActive;
                }
            })
            ->rawColumns(['show_at_home', 'status', 'action', 'product'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(FlashSaleItem $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('flashsaleitem-table')
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
            Column::make('product'),
            Column::make('show_at_home'),
            Column::make('status'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(120)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'FlashSaleItem_' . date('YmdHis');
    }
}
