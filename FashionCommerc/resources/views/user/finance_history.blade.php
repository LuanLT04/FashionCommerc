@extends('user.dashboard_user')

@section('content')
<title>Lịch sử giao dịch | Ví tài khoản</title>
<meta name="description" content="Xem lịch sử nạp tiền, rút tiền, giao dịch tài khoản khách hàng.">
<div class="container-fluid py-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 mb-4">
            <div class="list-group shadow-sm">
                <a href="{{ route('user.finance.dashboard') }}" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-wallet me-2"></i> Ví tài khoản
                </a>
                <a href="{{ route('user.finance.dashboard') }}#deposit" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-arrow-down me-2"></i> Nạp tiền
                </a>
                <a href="{{ route('user.finance.dashboard') }}#withdraw" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-arrow-up me-2"></i> Rút tiền
                </a>
                <a href="{{ route('user.finance.history') }}" class="list-group-item list-group-item-action active">
                    <i class="fa-solid fa-clock-rotate-left me-2"></i> Lịch sử giao dịch
                </a>
                <a href="{{ route('user.account') }}" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-user me-2"></i> Thông tin tài khoản
                </a>
            </div>
        </div>
        <!-- Main content -->
        <div class="col-md-9">
            <div class="card shadow mb-4">
                <div class="card-header bg-light fw-bold"><i class="fa-solid fa-clock-rotate-left me-2"></i> Lịch sử giao dịch</div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Thời gian</th>
                                    <th>Loại</th>
                                    <th>Số tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Mô tả</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $t)
                                <tr>
                                    <td>{{ $t->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @if($t->type == 'deposit')
                                            <span class="badge bg-primary">Nạp tiền</span>
                                        @else
                                            <span class="badge bg-danger">Rút tiền</span>
                                        @endif
                                    </td>
                                    <td class="fw-bold text-{{ $t->type == 'deposit' ? 'primary' : 'danger' }}">{{ number_format($t->amount, 0, ',', '.') }}đ</td>
                                    <td>
                                        @if($t->status == 'success')
                                            <span class="badge bg-success">Thành công</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $t->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $t->description }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="5" class="text-center text-muted">Chưa có giao dịch nào.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 