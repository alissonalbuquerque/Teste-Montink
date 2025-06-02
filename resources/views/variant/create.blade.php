<x-app-layout title="{{ __('Variants') }}">

    <x-slot name="main">

        <div class="border border-rounded px-2">
            <h1 class="h2 text-muted"> {{ __('Variant - :action', ['action' => __('Create')]) }}</h1>
        </div>

        <div class="border border-rounded my-4 p-4">

            <form action="{{route('variant.store')}}" method="POST">

                @csrf
                @method('POST')

                <input id="product_id" name="product_id" value="{{$product_id}}" type="hidden" />

                <div class="row">

                    <div class="col">

                        <div class="mb-3">
                            <label for="price" class="form-label">{{__('Price')}}</label>
                            <input id="price" name="price" type="number" min="1" step="0.01" class="form-control @error('price') is-invalid @enderror" aria-describedby="variant.price" value="{{ old('price') }}">
                            @error('price')
                                 <div class="invalid-feedback"> {{$message}} </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="size" class="form-label">{{__('Size')}}</label>
                            <select id="size" name="size" class="form-select" aria-label="size">
                                @foreach ($sizes as $value)
                                    <option value="{{$value}}">{{$value}}</option>    
                                @endforeach
                            </select>
                            @error('size')
                                 <div class="invalid-feedback"> {{$message}} </div>
                            @enderror
                        </div>

                    </div>

                    <div class="col">

                        <div class="mb-3">
                            <label for="color" class="form-label">{{__('Color')}}</label>
                            <select id="color" name="color" class="form-select" aria-label="size">
                                @foreach ($colors as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>    
                                @endforeach
                            </select>
                            @error('color')
                                 <div class="invalid-feedback"> {{$message}} </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">{{__('Quantity (Stock)')}}</label>
                            <input id="quantity" name="quantity" type="number" min="1" class="form-control @error('quantity') is-invalid @enderror" aria-describedby="variant.quantity" value="{{ old('quantity') }}">
                            @error('quantity')
                                 <div class="invalid-feedback"> {{$message}} </div>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="text-end">
                    <div class="btn-group">

                        <div class="mx-1">
                            <a href="{{ route('product.edit', ['id' => $product_id]) }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left-circle"></i> {{ __('Back') }}
                            </a>
                        </div>

                        <div class="mx-1">
                            <button type="submit" class="btn btn-outline-success">
                                <i class="bi bi-plus-circle"></i> {{ __('Create') }}
                            </button>
                        </div>

                    </div>
                </div>

            </form>

        </div>

    </x-slot>

</x-app-layout>
