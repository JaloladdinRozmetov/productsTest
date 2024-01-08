@extends('admin.layout')

@section('title', 'Home')

@section('content')
    <div class="container">
        <form action="{{ route('products.update',$product->id) }}" method="POST" class="bg-dark">
            @csrf
            @method('POST')
            <h2 class="text-white m-3">Редактировать {{$product->name}}</h2>
            <div class="mb-3 row">
                <label for="email" class="ml-2 col-md-2 col-form-label text-md-end text-start text-light">Артикул</label>
                <div class="col-md-4">
                    <input type="text" class="form-control @error('article') is-invalid @enderror" id="article" name="article" value="{{ $product->article}}" readonly>
                    @if ($errors->has('article'))
                        <span class="text-danger">{{ $errors->first('article') }}</span>
                    @endif
                </div>
            </div>
            <div class="mb-3 row">
                <label for="name" class="col-md-2 col-form-label text-md-end text-start text-light ml-2">Называние</label>
                <div class="col-md-4">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $product->name}}" readonly>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>
            <div class="mb-3 row">
                <label for="status" class="col-md-2 col-form-label text-md-end text-start text-light ml-2">Статус:</label>
                <div class="col-md-4">
                    <select name="status" id="status" class="form-control" required>
                        @if($product->status == 'available')
                            <option value="available" selected>Доступен</option>
                        @elseif($product->status == 'unavailable')
                            <option value="unavailable" selected>Не доступен</option>
                        @endif

                    </select>
                </div>
            </div>
            <div class="form-group" id="attributeContainer">
                <h3 class="text-light ml-2">Атрибуты</h3>
                    <?php $jsonData = json_decode($product->data) ?>
                @if($jsonData !==null)
                    @foreach($jsonData as $key=>$value)
                        <div class="attribute-row row ml-2">
                            <input type="text" name="attributes_name[]" class="form-control col-md-2" placeholder="Называние атрибута" value="{{ ucfirst($key) }}" required="" readonly>
                            <input type="text" name="attributes_value[]" class="form-control col-md-2" placeholder="Значения" value="{{$value}}" required="" readonly>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="mb-3 row">
                <a href="{{route('products.index')}}" class="col-md-2 btn btn-primary m-4">Назад</a>
            </div>

        </form>
    </div>
@endsection
