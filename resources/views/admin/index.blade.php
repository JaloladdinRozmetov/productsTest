@extends('admin.layout')

@section('title', 'Home')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">АРТИКУЛ</th>
                    <th scope="col">НАЗЫВАНИЕ</th>
                    <th scope="col">СТАТУС</th>
                    <th scope="col">АТРИБУТЫ</th>
                    <th scope="col" width="20"></th>
                    <th scope="col" width="20"></th>
                    <th scope="col" width="20"></th>
                </tr>
                </thead>
                <tbody class="bg-white">
                @foreach($products as $product)
                    <tr>
                        <th scope="row">{{$product->id}}</th>
                        <td>{{$product->article}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->status == 'available'?"Доступен":"Не доступно"}}</td>
                        <td>

                            <?php $jsonData = json_decode($product->data) ?>
                            @if($jsonData !==null)
                            @foreach($jsonData as $key=>$value)
                                <strong>{{ ucfirst($key) }}:</strong> {{ $value }}<br/>
                            @endforeach
                            @endif
                        </td>
                        <td>
                            <a href="{{route('products.edit',$product->id)}}" class="btn btn-link"><i class="bi-pencil"></i></a>
                        </td>
                        <td>
                            <a href="{{route('products.show',$product->id)}}" class="btn btn-link"><i class="bi-eye"></i></a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('products.destroy', $product->id) }}" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-link"><i class="bi-trash text-danger"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        <div class="col-md-2">
            <a href="{{route('products.create')}}" class="btn btn-primary m-3">
                Добовить
            </a>
        </div>
    </div>
    <style>
        thead{
            background-color: rgba(255, 255, 255, 0.70) !important;
        }
    </style>
@endsection
