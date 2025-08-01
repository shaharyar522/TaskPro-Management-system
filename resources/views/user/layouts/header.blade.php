<header class="dashboard-header">
    <div class="header-left">
        <!-- Dashboard and Report Titles (aligned to the left) -->
        <h1 class="header-title" onclick="showSection('form-section')">Dashboard</h1>
        <h1 class="header-title" onclick="showSection('report-section')">Report</h1>
    </div>

    <div class="header-right">
        <!-- Logout button with text inside -->
        <button class="logout-button"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i><br>
            <span class="logout-text">Logout</span>
        </button>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</header>

<style>
 /* Global Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
}

/* Dashboard Header */
.dashboard-header {
    background-color: #ffffff;
    padding: 0 20px;
    height: 70px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    position: sticky;
    top: 0;
    z-index: 1000;
}

/* Header Left */
.header-left {
    display: flex;
    justify-content: flex-start;
    gap: 30px;
    flex: 1;
}

.header-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #4e73df;
    margin: 0;
    cursor: pointer;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}

/* Header Right (Logout Button) */
.header-right {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    position: relative;
}

/* Logout button styling */
.logout-button {
    background: none;
    border: none;
    color: #333;
    font-size: 14px;
    cursor: pointer;
    text-align: center;
    flex-direction: column;
    align-items: center;
}

.logout-button i {
    font-size: 1.5rem;
}

.logout-text {
    font-size: 0.8rem;
    color: #6c757d;
    display: block;
}

/* Hover effect for Logout button */
.logout-button:hover {
    color: #224abe;
}

.logout-button:hover i {
    transform: scale(1.1);
}

/* Responsive Styles */

/* Extra small devices (phones, less than 576px) */
@media (max-width: 576px) {
    .dashboard-header {
        flex-direction: row; /* Keep layout as row to avoid stacking */
        padding: 0 10px;
        height: 70px; /* Maintain height */
    }

    .form-group-vertical input {
        width: 100% !important;
    }

    .header-left {
        flex: 1;
        justify-content: flex-start;
    }

    .header-title {
        font-size: 1.1rem;
    }

    .header-right {
        display: flex;
        justify-content: flex-end; /* Ensure logout button is on the right */
        align-items: center;
        gap: 12px; /* Maintain space between elements */
        width: auto; /* Avoid taking full width */
        margin-left: auto; /* Push logout to the right */
    }

    .logout-button {
        align-items: center; /* Center align text and icon */
        text-align: right;
        /*display: inline-flex; */
        margin-top: 0; /* Remove any margin */
        padding: 0; /* Ensure no extra padding */
    }

    .logout-text {
        font-size: 0.75rem;
    }
}

/* Additional Styles for other screen sizes */
@media (max-width: 768px) {
    .dashboard-header {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        padding: 0 10px;
    }

    .header-left {
        flex: 1;
        justify-content: flex-start;
    }

    .header-right {
        flex-shrink: 0;
        justify-content: flex-end;
    }

    .header-title {
        font-size: 1.1rem;
    }

    .logout-button {
        font-size: 1rem;
        width: 100%;
    }
}

@media (max-width: 992px) {
    .header-left {
        gap: 20px;
    }

    .header-title {
        font-size: 1.3rem;
    }

    .logout-button {
        font-size: 1rem;
    }
}

@media (max-width: 1200px) {
    .header-left {
        gap: 20px;
    }

    .header-title {
        font-size: 1.3rem;
    }

    .logout-button {
        font-size: 1rem;
    }
}

@media (min-width: 1200px) {
    .header-left {
        gap: 30px;
    }

    .header-title {
        font-size: 1.5rem;
    }

    .logout-button {
        font-size: 1.2rem;
    }
}

</style> 
