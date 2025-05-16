<x-app-layout title="{{ __('Products') }}">

    <x-slot name="main">

        <form action="{{route('product.update', ['id' => $model->id])}}" method="POST">

            @csrf
            @method('POST')

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col">

                    <div class="mb-3">
                        <label for="name" class="form-label">{{__('Name')}}</label>
                        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" aria-describedby="product.name" value="{{$model->name}}">
                    </div>

                </div>
            </div>

            {{--  --}}

            <table class="table">
            
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
                        <td class="text-end" colspan="6">
                            <a class="btn btn-primary text-center" href="{{''}}">
                                <i class="bi bi-plus-circle"></i>
                            </a>
                        </td>
                    </tr>

                    @foreach ($model->variants as $variant)
                        <tr>
                            <th scope="row"> {{ $loop->iteration }}</th>
                            <td>{{ $variant->config_decode('size') }}</td>
                            <td>{{ $variant->config_decode('color') }}</td>
                            <td>{{ $variant->price }}</td>
                            <td>{{ $variant->stock->quantity }}</td>
                            
                            {{-- <td>

                                <div class="btn-group" role="group" aria-label="Basic example">

                                    <div class="mx-1">
                                        <a class="btn btn-primary" href="{{route('product.edit', ['id' => $product->id])}}">
                                            {{__('Update')}}
                                        </a>
                                    </div>

                                    <div class="mx-1">
                                        <form action="{{route('product.delete', ['id' => $product->id])}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            
                                            <button class="btn btn-danger">{{__('Delete')}}</button>
                                        </form>
                                    </div>

                                </div>

                            </td> --}}

                        </tr>
                    @endforeach
                </tbody>
            
            </table>

            {{--  --}}

            <div class="text-end">
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
            </div>

        </form>

    </x-slot>

</x-app-layout>
