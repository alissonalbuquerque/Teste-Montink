<x-app-layout title="{{ __('Orders') }}">

    <x-slot name="main">

        <div class="row">

            <div class="btn-group mb-2">

                <div class="me-4">
                    <a class="btn btn-sm btn-outline-primary" href="{{route('cart.create')}}">
                        <i class="bi bi-cart"></i> {{ __('Cart') }} 
                        @session('products')
                            <span class="badge text-bg-danger">
                                {{ collect(session('products'))->count() }}
                            </span>
                        @endsession
                    </a>
                </div>

                <div class="me-4">
                    <a class="btn btn-sm btn-outline-primary" href="{{route('cupom.index')}}">
                        <i class="bi bi-ticket-perforated"></i> {{ __('Cupons') }}
                    </a>
                </div>

                <div class="me-4">
                    <a class="btn btn-sm btn-outline-primary" href="{{route('order.index')}}">
                        <i class="bi bi-bag"></i> {{ __('Orders') }}
                    </a>
                </div>

            </div>

            <hr>

            <div class="border border-rounded px-2 ">
                <h1 class="h2 text-muted"> {{ __('Orders') }}</h1>
            </div>

            <div class="border border-rounded px-2 my-2">

                <table class="table table-striped text-center align-middle">
                
                    <thead>
                        <tr>
                            <th class="text-muted" scope="col">{{__('#')}}</th>
                            <th class="text-muted" scope="col">{{__('E-Mail')}}</th>
                            <th class="text-muted" scope="col">{{__('Cupom')}}</th>
                            <th class="text-muted" scope="col">{{__('Cupom Value')}}</th>
                            <th class="text-muted" scope="col">{{__('Frete')}}</th>
                            <th class="text-muted" scope="col">{{__('Subtotal')}}</th>
                            <th class="text-muted" scope="col">{{__('Buy')}}</th>
                            <th class="text-muted" scope="col">{{__('Status')}}</th>
                            <th class="text-muted" scope="col">{{__('Payment Method')}}</th>
                        </tr>
                    </thead>

                    <tbody>
                        {{-- <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <a href="{{route('product.create')}}" class="btn btn-outline-success">
                                    <i class="bi bi-plus-circle"></i>
                                </a>
                            </td>
                        </tr> --}}
                        @foreach ($models as $model)
                            <tr>
                                <th scope="row"> {{ $loop->iteration }}</th>
                                <td>{{ $model->email }}</td>
                                <td>{{ $model->cupom_model?->code }}</td>
                                <td>{{ $model->fmt_cupom() }}</td>
                                <td>{{ $model->fmt_frete() }}</td>
                                <td>{{ $model->fmt_subtotal() }}</td>
                                <td>{{ $model->fmt_buy() }}</td>
                                <td>{{ $model->status_text() }}</td>
                                <td>{{ $model->payment_method_text() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                
                </table>

            </div>

        </div>

    </x-slot>

</x-app-layout>
