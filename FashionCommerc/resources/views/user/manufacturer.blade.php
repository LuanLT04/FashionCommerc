
@extends('user.dashboard_user')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Chọn Nhà Sản Xuất</h2>

    <div class="row mb-4">
        <div class="col-md-6 offset-md-3">
            <form action="" method="GET">
                <select class="form-control" onchange="location = this.value;">
                    <option value="" disabled selected>-- Chọn nhà sản xuất --</option>
                    @foreach ($manufacturers as $manufacturer)
                        <option value="{{ route('manufacturer.products', $manufacturer->id_manufacturer) }}">
                            {{ $manufacturer->name_manufacturer }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>
</div>
@endsection