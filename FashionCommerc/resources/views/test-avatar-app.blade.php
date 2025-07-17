@extends('layout.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">Test Avatar Dropdown - Layout App</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning">
                        <h5>Test trên Layout App:</h5>
                        <p>Trang này extend <code>layout.app</code> thay vì <code>user.dashboard_user</code></p>
                        <p><strong>Vấn đề:</strong> Trang này không có avatar dropdown trong navbar vì layout.app không có navbar với avatar.</p>
                        <p><strong>Giải pháp:</strong> Chỉ các trang extend user.dashboard_user mới có avatar dropdown.</p>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Test Controls</h5>
                            <button class="btn btn-primary me-2" onclick="testDropdown()">Test Manual Toggle</button>
                            <button class="btn btn-info me-2" onclick="checkStatus()">Check Status</button>
                            <button class="btn btn-success me-2" onclick="clearLog()">Clear Log</button>
                        </div>
                        <div class="col-md-6">
                            <h5>Current Status</h5>
                            <div id="status-info" class="bg-light p-3 rounded">
                                <div>Đang kiểm tra...</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <h5>Debug Log</h5>
                        <div id="debug-log" class="bg-dark text-light p-3 rounded" style="height: 300px; overflow-y: auto; font-family: monospace; font-size: 12px;">
                            <div>Debug log sẽ hiển thị ở đây...</div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <h5>Kết luận</h5>
                        <div class="alert alert-info">
                            <p>Layout <code>layout.app</code> được sử dụng cho:</p>
                            <ul>
                                <li>Trang đăng nhập</li>
                                <li>Trang đăng ký</li>
                                <li>Các trang không cần navbar với avatar</li>
                            </ul>
                            <p>Layout <code>user.dashboard_user</code> được sử dụng cho:</p>
                            <ul>
                                <li>Trang chủ</li>
                                <li>Trang sản phẩm</li>
                                <li>Trang giỏ hàng</li>
                                <li>Trang đơn hàng</li>
                                <li>Tất cả các trang có navbar với avatar</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function log(message) {
    const debugLog = document.getElementById('debug-log');
    const timestamp = new Date().toLocaleTimeString();
    debugLog.innerHTML += `<div>[${timestamp}] ${message}</div>`;
    debugLog.scrollTop = debugLog.scrollHeight;
}

function testDropdown() {
    const avatarDropdown = document.getElementById('avatarDropdown');
    if (!avatarDropdown) {
        log('EXPECTED: Avatar dropdown not found (this layout doesn\'t have avatar)');
        return;
    }
    
    const dropdownMenu = avatarDropdown.nextElementSibling;
    if (!dropdownMenu) {
        log('ERROR: Dropdown menu not found');
        return;
    }
    
    dropdownMenu.classList.toggle('show');
    const isOpen = dropdownMenu.classList.contains('show');
    log(`Manual toggle: Dropdown is now ${isOpen ? 'OPEN' : 'CLOSED'}`);
}

function checkStatus() {
    const statusInfo = document.getElementById('status-info');
    const avatarDropdown = document.getElementById('avatarDropdown');
    
    const status = {
        'Layout type': 'layout.app',
        'Avatar element found': !!avatarDropdown,
        'Bootstrap loaded': typeof bootstrap !== 'undefined',
        'jQuery loaded': typeof $ !== 'undefined',
        'Avatar fix script loaded': typeof initializeAvatarDropdown !== 'undefined',
        'Expected result': 'Avatar should NOT be found in this layout'
    };
    
    let html = '<strong>Current Status:</strong><br>';
    Object.entries(status).forEach(([key, value]) => {
        const color = key === 'Avatar element found' && value === false ? 'text-success' :
                     key === 'Avatar element found' && value === true ? 'text-warning' :
                     value === true ? 'text-success' : 
                     value === false ? 'text-danger' : 'text-info';
        html += `<div class="${color}">${key}: ${value}</div>`;
    });
    
    statusInfo.innerHTML = html;
    
    // Also log to debug
    log('=== STATUS CHECK ===');
    Object.entries(status).forEach(([key, value]) => {
        log(`${key}: ${value}`);
    });
}

function clearLog() {
    document.getElementById('debug-log').innerHTML = '<div>Debug log cleared</div>';
}

// Auto check status when page loads
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        log('Page loaded (layout.app), checking status...');
        checkStatus();
    }, 1000);
});
</script>
@endsection
