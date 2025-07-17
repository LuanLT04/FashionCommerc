@extends('user.dashboard_user')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Test Avatar Dropdown</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h5>Hướng dẫn test:</h5>
                        <ol>
                            <li>Nhấn vào avatar ở góc trên bên phải</li>
                            <li>Kiểm tra xem dropdown có mở ra không</li>
                            <li>Nhấn ra ngoài để đóng dropdown</li>
                            <li>Kiểm tra console để xem log</li>
                        </ol>
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
        log('ERROR: Avatar dropdown not found');
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
        'Avatar element found': !!avatarDropdown,
        'Bootstrap loaded': typeof bootstrap !== 'undefined',
        'jQuery loaded': typeof $ !== 'undefined',
        'Avatar fix script loaded': typeof initializeAvatarDropdown !== 'undefined',
        'Dropdown menu found': !!(avatarDropdown && avatarDropdown.nextElementSibling),
        'Current dropdown state': avatarDropdown && avatarDropdown.nextElementSibling ? 
            (avatarDropdown.nextElementSibling.classList.contains('show') ? 'OPEN' : 'CLOSED') : 'N/A'
    };
    
    let html = '<strong>Current Status:</strong><br>';
    Object.entries(status).forEach(([key, value]) => {
        const color = value === true || value === 'CLOSED' ? 'text-success' : 
                     value === false || value === 'OPEN' ? 'text-danger' : 'text-info';
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
        log('Page loaded, checking status...');
        checkStatus();
        
        // Test avatar click
        const avatarDropdown = document.getElementById('avatarDropdown');
        if (avatarDropdown) {
            log('Setting up test click listener...');
            avatarDropdown.addEventListener('click', function() {
                log('Avatar clicked (test listener detected)');
            });
        }
    }, 1000);
});
</script>
@endsection
