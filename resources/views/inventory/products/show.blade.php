@extends('layouts.app', ['page' => 'Product Information', 'pageSlug' => 'products', 'section' => 'inventory'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Produk informasi</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>kategori</th>
                            <th>Nama</th>
                            <th>Stok</th>
                            <th>Stok Rusak</th>
                            <th>Harga satuan</th>
                            <th>Harga Rata Rata</th>
                            <th>Total Jual</th>
                            <th>Pendapatan Dihasilkan</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td><a href="{{ route('categories.show', $product->category) }}">{{ $product->category->name }}</a></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->stock_defective }}</td>
                                <td>{{ format_money($product->price) }}</td>
                                <td>{{ format_money($product->solds->avg('price')) }}</td>
                                <td>{{ $product->solds->sum('qty') }}</td>
                                <td>{{ format_money($product->solds->sum('total_amount')) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Terjual Terakhir</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>Date</th>
                            <th>Sale ID</th>
                            <th>Quantity</th>
                            <th>harga satuan</th>
                            <th>Total semua</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($solds as $sold)
                                <tr>
                                    <td>{{ date('d-m-y', strtotime($sold->created_at)) }}</td>
                                    <td><a href="{{ route('sales.show', $sold->sale_id) }}">{{ $sold->sale_id }}</a></td>
                                    <td>{{ $sold->qty }}</td>
                                    <td>{{ format_money($sold->price) }}</td>
                                    <td>{{ format_money($sold->total_amount) }}</td>
                                    <td class="td-actions text-right">
                                        <a href="{{ route('sales.show', $sold->sale_id) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="View Sale">
                                            <i class="tim-icons icon-zoom-split"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Kwitansi terakhir</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>Date</th>
                            <th>Receipt ID</th>
                            <th>Title</th>
                            <th>stok</th>
                            <th>Stok rusak</th>
                            <th>Total stok</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($receiveds as $received)
                                <tr>
                                    <td>{{ date('d-m-y', strtotime($received->created_at)) }}</td>
                                    <td><a href="{{ route('receipts.show', $received->receipt) }}">{{ $received->receipt_id }}</a></td>
                                    <td style="max-width:150px;">{{ $received->receipt->title }}</td>
                                    <td>{{ $received->stock }}</td>
                                    <td>{{ $received->stock_defective }}</td>
                                    <td>{{ $received->stock + $received->stock_defective }}</td>
                                    <td class="td-actions text-right">
                                        <a href="{{ route('receipts.show', $received->receipt) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Ver Receipt">
                                            <i class="tim-icons icon-zoom-split"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
