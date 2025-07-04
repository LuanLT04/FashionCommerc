@extends('user.account_dashboard')

@section('account_content')
<div class="card shadow-lg mb-4">
    <div class="card-header bg-primary text-white d-flex align-items-center">
        <i class="fa-solid fa-wallet fa-2x me-2"></i>
        <h4 class="mb-0">Quản lý ví</h4>
    </div>
    <div class="card-body">
        @include('user.partials.alerts')
        
        <!-- Số dư -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Số dư hiện tại</h5>
                        <h3 class="text-success mb-0">{{ number_format(Auth::user()->balance ?? 0, 0, ',', '.') }}đ</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Tổng giao dịch</h5>
                        <h3 class="text-info mb-0">{{ number_format($totalDeposit - $totalWithdraw, 0, ',', '.') }}đ</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nạp/Rút tiền -->
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <i class="fa-solid fa-arrow-down me-2"></i>Nạp tiền
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.finance.deposit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="deposit_amount" class="form-label">Số tiền nạp</label>
                                <div class="input-group">
                                    <input type="number" name="amount" id="deposit_amount" class="form-control" min="10000" step="10000" required>
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                                <small class="text-muted">Tối thiểu 10,000đ</small>
                            </div>
                            <button type="submit" class="btn btn-success">Nạp tiền</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        <i class="fa-solid fa-arrow-up me-2"></i>Rút tiền
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.finance.withdraw') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="withdraw_amount" class="form-label">Số tiền rút</label>
                                <div class="input-group">
                                    <input type="number" name="amount" id="withdraw_amount" class="form-control" min="10000" step="10000" required>
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                                <small class="text-muted">Tối thiểu 10,000đ</small>
                            </div>
                            <button type="submit" class="btn btn-warning">Rút tiền</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lịch sử giao dịch gần đây -->
        <div class="card">
            <div class="card-header bg-info text-white">
                <i class="fa-solid fa-clock-rotate-left me-2"></i>Giao dịch gần đây
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Thời gian</th>
                                <th>Loại</th>
                                <th>Số tiền</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    @if($transaction->type == 'deposit')
                                        <span class="badge bg-success">Nạp tiền</span>
                                    @else
                                        <span class="badge bg-warning">Rút tiền</span>
                                    @endif
                                </td>
                                <td class="{{ $transaction->type == 'deposit' ? 'text-success' : 'text-danger' }}">
                                    {{ $transaction->type == 'deposit' ? '+' : '-' }}{{ number_format($transaction->amount, 0, ',', '.') }}đ
                                </td>
                                <td>
                                    @if($transaction->status == 'success')
                                        <span class="badge bg-success">Thành công</span>
                                    @elseif($transaction->status == 'pending')
                                        <span class="badge bg-warning">Đang xử lý</span>
                                    @else
                                        <span class="badge bg-danger">Thất bại</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Chưa có giao dịch nào</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="text-end mt-3">
                    <a href="{{ route('user.finance.history') }}" class="btn btn-outline-primary">
                        <i class="fa-solid fa-list me-2"></i>Xem tất cả
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 