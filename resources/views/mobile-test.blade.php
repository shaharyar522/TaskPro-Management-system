@extends('layouts.app')
@section('content')
<!-- Header -->
@include('layouts.header')

<!-- Test Content -->
<div class="dashboard-container">
    <div class="welcome-card">
        <div class="welcome-content">
            <div class="welcome-header">
                <h1 class="welcome-title">Mobile Sidebar Test</h1>
                <p class="welcome-text">Test the mobile sidebar functionality on your mobile device</p>
            </div>
            
            <div class="test-instructions">
                <h3>Instructions:</h3>
                <ul>
                    <li>Click the hamburger menu (☰) button in the top-left corner</li>
                    <li>The sidebar should slide in from the left</li>
                    <li>Click outside the sidebar or the overlay to close it</li>
                    <li>Try swiping right from the left edge to open</li>
                    <li>Try swiping left when sidebar is open to close it</li>
                </ul>
                
                <h3>Debug Information:</h3>
                <div id="debug-info">
                    <p>Window Width: <span id="window-width"></span></p>
                    <p>Device Type: <span id="device-type"></span></p>
                    <p>Sidebar State: <span id="sidebar-state"></span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.test-instructions {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin-top: 20px;
}

.test-instructions h3 {
    color: #4361ee;
    margin-bottom: 10px;
}

.test-instructions ul {
    margin-left: 20px;
}

.test-instructions li {
    margin-bottom: 8px;
    color: #666;
}

#debug-info {
    background: #e9ecef;
    padding: 15px;
    border-radius: 5px;
    margin-top: 15px;
    font-family: monospace;
    font-size: 14px;
}

#debug-info p {
    margin-bottom: 5px;
}

#debug-info span {
    font-weight: bold;
    color: #4361ee;
}
</style>

<script>
// Debug script to show current state
function updateDebugInfo() {
    document.getElementById('window-width').textContent = window.innerWidth + 'px';
    document.getElementById('device-type').textContent = window.innerWidth <= 768 ? 'Mobile' : 'Desktop';
    
    const sidebar = document.getElementById('sidebar');
    if (sidebar) {
        const isVisible = sidebar.classList.contains('show');
        document.getElementById('sidebar-state').textContent = isVisible ? 'Visible' : 'Hidden';
    }
}

// Update debug info on load and resize
document.addEventListener('DOMContentLoaded', updateDebugInfo);
window.addEventListener('resize', updateDebugInfo);

// Update debug info when sidebar state changes
const observer = new MutationObserver(function(mutations) {
    mutations.forEach(function(mutation) {
        if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
            updateDebugInfo();
        }
    });
});

const sidebar = document.getElementById('sidebar');
if (sidebar) {
    observer.observe(sidebar, { attributes: true });
}
</script>
@endsection 