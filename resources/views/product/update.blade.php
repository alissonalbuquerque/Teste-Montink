<x-app-layout title="{{ __('Products') }}">

    <x-slot name="main">

        <div class="border border-rounded px-2">
            <h1 class="h2 text-muted"> {{ __('Product - :action', ['action' => __('Update')]) }}</h1>
        </div>

        @if(session('success'))
            <div class="my-4">
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    <span class="mx-2"> {{ session('success') }} </span>
                    <button type="button" class="btn-close text-end" data-bs-dismiss="alert" aria-label="close"></button>
                </div>
            </div>
        @endif

        <div class="border border-rounded my-4 p-4">

            <form id="form_product_update" action="{{route('product.update', ['id' => $model->id])}}" method="POST">

                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col">

                        <div class="mb-3">
                            <label for="name" class="form-label">{{__('Name')}}</label>
                            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" aria-describedby="product.name" value="{{$model->name}}">
                            @error('name')
                                <div class="invalid-feedback"> {{$message}} </div>
                            @enderror
                        </div>

                    </div>
                </div>

            </form>

            {{--  --}}
            
            <div class="border border-rounded mb-4 p-4">
                
                <div class="border border-rounded px-2 py-2 mb-4">
                    <h1 class="h4 text-muted"> {{ __('Variations') }}</h1>
                </div>

                <table class="table text-center align-middle">
                
                    <thead>
                        <tr>
                            <th scope="col">{{__('#')}}</th>
                            <th scope="col">{{__('Size')}}</th>
                            <th scope="col">{{__('Color')}}</th>
                            <th scope="col">{{__('Price')}}</th>
                            <th scope="col">{{__('Quantity (Stock)')}}</th>
                            <th scope="col" class="">{{__('Actions')}}</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <a href="{{route('variant.create', ['product_id' => $model->id])}}" class="btn btn-outline-success">
                                    <i class="bi bi-plus-circle"></i>
                                </a>
                            </td>
                        </tr>

                        @foreach ($model->variants as $variant)
                            <tr>
                                <th scope="row"> {{ $loop->iteration }}</th>
                                <td>{{ $variant->config_decode('size') }}</td>
                                <td>{{ $variant->fmt_color() }}</td>
                                <td>{{ $variant->fmt_price() }}</td>
                                <td>{{ $variant->stock->quantity }}</td>

                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">

                                        <div class="mx-1">
                                            <a class="btn btn-outline-primary" href="{{route('variant.edit', ['id' => $variant->id])}}">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        </div>

                                        <div class="mx-1">
                                            <form action="{{route('variant.delete', ['id' => $variant->id])}}" method="POST">

                                                @method('DELETE')
                                                @csrf
                                                
                                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir esta variação?')">
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
            {{--  --}}

            <div class="text-end">
                <div class="btn-group">

                    <div class="mx-1">
                        <a href="{{ route('product.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left-circle"></i> {{ __('Back') }}
                        </a>
                    </div>

                    <div class="mx-1">
                        <div class="text-end">
                            <button class="btn btn-primary" type="button" onclick="document.getElementById('form_product_update').submit()">
                                <i class="bi bi-arrow-clockwise"></i> {{ __('Update') }}
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </x-slot>

</x-app-layout>
