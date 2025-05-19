<x-app-layout title="{{ __('Products') }}">

    <x-slot name="main">

        <div class="row">

            @if(session('success'))
                <div class="my-4">
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="bi bi-check-circle-fill"></i>
                        <span class="mx-2"> {{ session('success') }} </span>
                        <button type="button" class="btn-close text-end" data-bs-dismiss="alert" aria-label="close"></button>
                    </div>
                </div>
            @endif   

            <div class="border border-rounded px-2">
                <h1 class="h2 text-muted"> {{ __('Products') }}</h1>
            </div>

            <table class="table table-striped text-center align-middle">
            
                <thead>
                    <tr>
                        <th class="text-muted" scope="col">{{__('#')}}</th>
                        <th class="text-muted" scope="col">{{__('Products')}}</th>
                        <th class="text-muted" scope="col">{{__('Variations')}}</th>
                        <th class="text-muted" scope="col">{{__('Actions')}}</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a href="{{route('product.create')}}" class="btn btn-outline-success">
                                <i class="bi bi-plus-circle"></i>
                            </a>
                        </td>
                    </tr>
                    @foreach ($products as $product)
                        <tr>
                            <th scope="row"> {{ $loop->iteration }}</th>
                            <td>{{ $product->name }}</td>
                            <td>
                                {{--  --}}
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal-{{$product->id}}">
                                    <i class="bi bi-eye"></i> : {{ $product->qtd_variants() }}
                                </button>
                                {{--  --}}

                                <!-- Modal -->
                                <div class="modal fade" id="modal-{{$product->id}}" tabindex="-1" aria-labelledby="modal-title-{{$product->id}}" aria-hidden="true">

                                    <div class="modal-dialog">

                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="modal-title-{{$product->id}}">{{$product->name}}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">

                                                <table class="table text-center align-middle">
                    
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">{{__('#')}}</th>
                                                            <th scope="col" class="text-center">{{__('Size')}}</th>
                                                            <th scope="col" class="text-center">{{__('Color')}}</th>
                                                            <th scope="col" class="text-center">{{__('Price')}}</th>
                                                            <th scope="col" class="text-center">{{__('Stock')}}</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach ($product->variants as $variant)
                                                            <tr>
                                                                <th scope="row"> {{ $loop->iteration }}</th>
                                                                <td class="text-center">{{ $variant->config_decode('size') }}</td>
                                                                <td class="text-center">{{ $variant->fmt_color() }}</td>
                                                                <td class="text-center">{{ $variant->fmt_price() }}</td>
                                                                <td class="text-center">{{ $variant->stock->quantity }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>

                                                </table>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                    <i class="bi bi-x-circle"></i> {{ __('Close') }}
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                {{--  --}}

                            </td>
                            <td>

                                <div class="btn-group" role="group" aria-label="Basic example">

                                    <div class="mx-1">
                                        <a class="btn btn-outline-primary" href="{{route('product.edit', ['id' => $product->id])}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </div>

                                    <div class="mx-1">
                                        <form action="{{route('product.delete', ['id' => $product->id])}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            
                                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir este produto?')">
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

    </x-slot>

</x-app-layout>
