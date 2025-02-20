<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SellerPendingProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query){
                $editBtn = "<a href='".route('admin.products.edit', $query->id)."' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='".route('admin.products.destroy', $query->id)."' class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";
                $moreBtn = '<div class="dropdown dropleft d-inline">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-cog"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item has-icon" href="'.route('admin.products-image-gallery.index', ['product' => $query->id]).'"><i class="far fa-heart"></i> Image gallery</a>
                        <a class="dropdown-item has-icon" href="'.route('admin.products-variant.index', ['product' => $query->id]).'"><i class="far fa-file"></i> Variants</a>
                    </div>
                    </div>';
                return $editBtn.$deleteBtn.$moreBtn;
            })
            ->addColumn('image', function($query){
                return "<img width='100px' src='".asset($query->thumb_image)."'></img>";
            })
            ->addColumn('type', function($query){
                switch($query->product_type){
                    case 'new_arrival':
                        return '<i class="badge bg-success">New Arrival</i>';
                        break;
                    case 'featured_product':
                        return '<i class="badge bg-success">Featured Product</i>';
                        break;
                    case 'top_product':
                        return '<i class="badge bg-success">Top Product</i>';
                        break;
                    case 'best_product':
                        return '<i class="badge bg-success">Best Product</i>';
                        break;
                    default:
                        return '<i class="badge bg-dark">None</i>';
                        break;
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
            ->addColumn('approve', function($query){
                return "<select class='form-control is_approve' data-id='$query->id'>
                    <option value='0'>Pending</option>
                    <option value='1'>Approved</option>
                </select>";
            })
            ->addColumn('vendor', function($query){
                return $query->vendor->shop_name;
            })
            ->rawColumns(['action', 'image', 'type', 'status', 'approve'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('is_approved', 0)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('sellerpendingproduct-table')
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
            Column::make('id')->width(10),
            Column::make('name')->width(150),
            Column::make('vendor')->width(80),
            Column::make('image')->width(80),
            Column::make('price')->width(100),
            Column::make('type')->width(50),
            Column::make('status')->width(70),
            Column::make('approve')->width(70),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(120)
                  ->addClass('text-center')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'SellerPendingProducts_' . date('YmdHis');
    }
}

