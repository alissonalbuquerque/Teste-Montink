<x-app-layout title="{{ __('Cupons') }}">

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
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('product.index') }}">
                        <i class="bi bi-ticket-perforated"></i> {{ __('Products') }}
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
                <h1 class="h2 text-muted"> {{ __('Cupons') }}</h1>
            </div>

            <div class="border border-rounded px-2 my-2">

                <table class="table table-striped text-center align-middle">
                
                    <thead>
                        <tr>
                            <th class="text-muted" scope="col">{{__('#')}}</th>
                            <th class="text-muted" scope="col">{{__('Code')}}</th>
                            <th class="text-muted" scope="col">{{__('Start Date')}}</th>
                            <th class="text-muted" scope="col">{{__('End Date')}}</th>
                            <th class="text-muted" scope="col">{{__('Minimal Value')}}</th>
                            <th class="text-muted" scope="col">{{__('Percentage')}}</th>
                            <th class="text-muted" scope="col">{{__('Active')}}</th>
                            <th class="text-muted" scope="col">{{__('Actions')}}</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <a href="{{route('cupom.create')}}" class="btn btn-outline-success">
                                    <i class="bi bi-plus-circle"></i>
                                </a>
                            </td>
                        </tr>
                        @foreach ($models as $model)
                            <tr>
                                <th scope="row"> {{ $loop->iteration }}</th>
                                <td>{{ $model->code }}</td>
                                <td>{{ $model->fmt_start_date() }}</td>
                                <td>{{ $model->fmt_end_date() }}</td>
                                <td>{{ $model->fmt_minimal_value() }}</td>
                                <td>{{ $model->fmt_percentage() }}</td>
                                <td>{{ $model->fmt_active() }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">

                                        <div class="mx-1">
                                            <a class="btn btn-outline-primary" href="{{route('cupom.edit', ['id' => $model->id])}}">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        </div>

                                        <div class="mx-1">
                                            <form action="{{route('cupom.delete', ['id' => $model->id])}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                
                                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir este cupom?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                
                </table>

            </div>

        </div>

    </x-slot>

</x-app-layout>
