@extends('COMMON.layout.layout_admin')

@section('title')
    Admin | Proudct List
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ URL::asset('css/adminProductList.css') }}">
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- <script src="{{ URL::asset('js/orderTransaction.js') }}"></script> --}}
@endsection


@section('body')
    <div class="col-md-10">
        <div class="status text fs-2 fw-bold mb-4 mt-4">{{ __('messageAMK.ProductList') }}</div>
        <div class="row ">
            <div class="col-md-12 roow">
                <table class="table  boxshad me-5">
                    <thead>
                        <tr class="tableheader tablerows">
                            <th scope="col">{{ __('messageAMK.No.') }}</th>
                            <th scope="col">{{ __('messageAMK.ProductName') }}</th>
                            <th scope="col">{{ __('messageAMK.ProductId') }}</th>
                            <th scope="col">{{ __('messageAMK.Type') }}</th>
                            <th scope="col">{{ __('messageAMK.Taste') }}</th>
                            <th scope="col">{{ __('messageAMK.Coin') }}</th>
                            <th scope="col">{{ __('messageAMK.Amount') }}</th>
                            <th scope="col">{{ __('messageAMK.Avaliable') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="scroll">

                        @forelse ($products as $product)
                            @if ($product->avaliable == 1)
                                <tr class="tablecolor1  tablerows bg-success">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->pid }}</td>
                                    <td>{{ $product->favourite_food }}</td>
                                    <td>{{ $product->taste }}</td>
                                    <td>{{ $product->coin }}</td>
                                    <td>{{ number_format($product->amount) }} MMK</td>
                                    <td>Avaliable</td>
                                    <td>
                                        <a href="{{ route('product.edit', $product->pid) }}"><button
                                                class="btn btn-outline-light"><i class="bi bi-arrow-right"></i></button></a>
                                    </td>
                                </tr>

                            @else
                                <tr class="tablecolor1  tablerows">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->pid }}</td>
                                    <td>{{ $product->favourite_food }}</td>
                                    <td>{{ $product->taste }}</td>
                                    <td>{{ $product->coin }}</td>
                                    <td>{{ number_format($product->amount) }} MMK</td>
                                    <td>Not Avaliable</td>
                                    <td>
                                        <a href="{{ route('product.edit', $product->pid) }}"><button
                                                class="btn btn-outline-light"><i class="bi bi-arrow-right"></i></button></a>
                                    </td>
                                </tr>

                            @endif

                        @empty
                            There is no product.
                        @endforelse
                    </tbody>
                </table>

            </div>


            <div class="d-flex justify-content-center">{{ $products->links() }}</div>

            <div class="d-flex justify-content-end ">
                <a href="/product" class="m-3"><button
                        class="btn text-light  active btncust">{{ __('messageAMK.Product Add') }}</button></a>
            </div>

        </div>
    </div>



    </div>
@endsection
