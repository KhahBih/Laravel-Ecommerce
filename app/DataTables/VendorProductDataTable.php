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
use Illuminate\Support\Facades\Auth;


class VendorProductDataTable extends DataTable
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
            $editBtn = "<a href='".route('vendor.products.edit', $query->id)."' class='btn btn-primary'><i class='far fa-edit'></i></a>";
            $deleteBtn = "<a href='".route('vendor.products.destroy', $query->id)."' class='btn btn-danger delete-item' style='margin-left: 4px'><i class='far fa-trash-alt'></i></a>";
            $imageGalleryBtn = '<a style="margin: 0 5px 0 5px!important; padding: 6px 15px 6px 15px!important" class="btn btn-success" href="'.route('vendor.vendor-product-image-gallery.index', ['product' => $query->id]).'"><i class="far fa-file-image"></i></a>';
            $variantBtn = '<a class="btn btn-warning" href="'.route('vendor.products-variant.index', ['product' => $query->id]).'"><i class="far fa-star"></i></a>';
            return $editBtn.$deleteBtn.$imageGalleryBtn.$variantBtn;
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
                    return '<i class="badge bg-warning">Featured Product</i>';
                    break;
                case 'top_product':
                    return '<i class="badge bg-info">Top Product</i>';
                    break;
                case 'best_product':
                    return '<i class="badge bg-danger">Best Product</i>';
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
        ->rawColumns(['action', 'image', 'type', 'status'])
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('vendor_id', Auth::user()->vendor->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendorproduct-table')
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
            Column::make('image')->width(80),
            Column::make('price')->width(100),
            Column::make('type')->width(70),
            Column::make('status')->width(70),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(150)
                  ->addClass('text-center')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorProduct_' . date('YmdHis');
    }
}
