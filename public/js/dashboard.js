/**
 * ================================================================
 * B2B WHOLESALE ADMIN — dashboard.js
 * Premium Admin Dashboard JavaScript
 * Pure JS, No jQuery
 * ================================================================
 */

'use strict';

/* ── Utility helpers ────────────────────────────────────────────── */
const $ = (sel, ctx = document) => ctx.querySelector(sel);
const $$ = (sel, ctx = document) => [...ctx.querySelectorAll(sel)];

function onReady(fn) {
    if (document.readyState !== 'loading') fn();
    else document.addEventListener('DOMContentLoaded', fn);
}

/* ─────────────────────────────────────────────────────────────────
   1. SIDEBAR TOGGLE
   ───────────────────────────────────────────────────────────────── */
function initSidebar() {
    const sidebar        = $('#sidebar');
    const overlay        = $('#sidebarOverlay');
    const toggleBtn      = $('#sidebarToggleBtn');
    const closeBtn       = $('#sidebarCloseBtn');
    const mainArea       = $('#mainArea');
    const topNavbar      = $('#topNavbar');

    if (!sidebar || !toggleBtn) return;

    let isOpen = window.innerWidth >= 1024;

    function openSidebar() {
        isOpen = true;
        sidebar.classList.add('open');
        overlay.classList.add('active');
        toggleBtn.classList.add('active');
        toggleBtn.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = window.innerWidth < 1024 ? 'hidden' : '';
    }

    function closeSidebar() {
        isOpen = false;
        sidebar.classList.remove('open');
        overlay.classList.remove('active');
        toggleBtn.classList.remove('active');
        toggleBtn.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    function toggleSidebar() {
        isOpen ? closeSidebar() : openSidebar();
    }

    toggleBtn.addEventListener('click', toggleSidebar);
    if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
    overlay.addEventListener('click', closeSidebar);

    // Keyboard: Escape closes sidebar on mobile
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && isOpen && window.innerWidth < 1024) {
            closeSidebar();
        }
    });

    // Handle resize
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            if (window.innerWidth >= 1024) {
                // Desktop: reset
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
                toggleBtn.classList.remove('active');
                document.body.style.overflow = '';
                isOpen = false;
            }
        }, 100);
    });
}

/* ─────────────────────────────────────────────────────────────────
   2. DARK MODE TOGGLE
   ───────────────────────────────────────────────────────────────── */
function initDarkMode() {
    const btn  = $('#themeToggleBtn');
    const icon = $('#themeIcon');
    const html = document.documentElement;

    if (!btn) return;

    const STORAGE_KEY = 'ws-admin-theme';
    const savedTheme  = localStorage.getItem(STORAGE_KEY) || 'light';

    function applyTheme(theme) {
        html.setAttribute('data-theme', theme);
        localStorage.setItem(STORAGE_KEY, theme);

        if (theme === 'dark') {
            icon.className = 'bi bi-sun-fill';
            btn.setAttribute('aria-label', 'Switch to light mode');
            // Update Chart.js defaults for dark mode
            if (window.Chart) {
                Chart.defaults.color = '#94A3B8';
                Chart.defaults.borderColor = '#334155';
            }
        } else {
            icon.className = 'bi bi-moon-stars-fill';
            btn.setAttribute('aria-label', 'Switch to dark mode');
            if (window.Chart) {
                Chart.defaults.color = '#6B7280';
                Chart.defaults.borderColor = '#E5E7EB';
            }
        }

        // Re-render charts when theme changes
        if (window._dashboardCharts) {
            window._dashboardCharts.forEach(chart => chart.update());
        }
    }

    applyTheme(savedTheme);

    btn.addEventListener('click', () => {
        const current = html.getAttribute('data-theme') || 'light';
        applyTheme(current === 'dark' ? 'light' : 'dark');
    });
}

/* ─────────────────────────────────────────────────────────────────
   3. GREETING + LIVE CLOCK
   ───────────────────────────────────────────────────────────────── */
function initGreetingAndClock() {
    const greetingText = $('#greetingText');
    const greetingEmoji = $('#greetingEmoji');
    const dateEl   = $('#currentDate');
    const timeEl   = $('#currentTime');

    const hour = new Date().getHours();
    let greeting, emoji;

    if (hour >= 5 && hour < 12) {
        greeting = 'Good morning, Super Admin!';
        emoji    = '☀️';
    } else if (hour >= 12 && hour < 17) {
        greeting = 'Good afternoon, Super Admin!';
        emoji    = '🌤️';
    } else if (hour >= 17 && hour < 21) {
        greeting = 'Good evening, Super Admin!';
        emoji    = '🌇';
    } else {
        greeting = 'Working late, Super Admin!';
        emoji    = '🌙';
    }

    if (greetingText) greetingText.textContent = greeting;
    if (greetingEmoji) greetingEmoji.textContent = emoji;

    function updateClock() {
        const now = new Date();
        const dateStr = now.toLocaleDateString('en-US', {
            weekday: 'long', day: 'numeric', month: 'long', year: 'numeric',
        });
        const timeStr = now.toLocaleTimeString('en-US', {
            hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true,
        });
        if (dateEl) dateEl.textContent = dateStr;
        if (timeEl) timeEl.textContent = timeStr;
    }

    updateClock();
    setInterval(updateClock, 1000);
}

/* ─────────────────────────────────────────────────────────────────
   4. ANIMATED COUNTER
   ───────────────────────────────────────────────────────────────── */
function animateCounter(el, target, prefix = '', suffix = '', duration = 1200) {
    const start     = 0;
    const startTime = performance.now();

    function ease(t) {
        return t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t;
    }

    function step(now) {
        const elapsed  = now - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const value    = Math.round(ease(progress) * target);
        el.textContent = prefix + value.toLocaleString() + suffix;
        if (progress < 1) requestAnimationFrame(step);
        else el.textContent = prefix + target.toLocaleString() + suffix;
    }

    requestAnimationFrame(step);
}

function initCounters() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            const el     = entry.target;
            const target = parseInt(el.getAttribute('data-count'), 10);
            const prefix = el.getAttribute('data-prefix') || '';
            const suffix = el.getAttribute('data-suffix') || '';

            if (!isNaN(target)) {
                animateCounter(el, target, prefix, suffix);
            }
            observer.unobserve(el);
        });
    }, { threshold: 0.3 });

    $$('[data-count]').forEach(el => observer.observe(el));
}

/* ─────────────────────────────────────────────────────────────────
   5. CHARTS — Monthly Sales
   ───────────────────────────────────────────────────────────────── */
function initMonthlySalesChart() {
    const canvas = $('#monthlySalesChart');
    if (!canvas || !window.Chart || !window.DashboardData) return;

    const data   = window.DashboardData.monthlySales;
    const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
    const gridColor = isDark ? 'rgba(255,255,255,.06)' : 'rgba(0,0,0,.05)';

    const primaryGradient = canvas.getContext('2d').createLinearGradient(0, 0, 0, 300);
    primaryGradient.addColorStop(0, 'rgba(37,99,235,0.18)');
    primaryGradient.addColorStop(1, 'rgba(37,99,235,0.00)');

    const ordersGradient = canvas.getContext('2d').createLinearGradient(0, 0, 0, 300);
    ordersGradient.addColorStop(0, 'rgba(34,197,94,0.18)');
    ordersGradient.addColorStop(1, 'rgba(34,197,94,0.00)');

    const chartConfig = {
        type: 'line',
        data: {
            labels: data.labels,
            datasets: [
                {
                    id: 'revenue',
                    label: 'Revenue ($)',
                    data: data.revenue,
                    borderColor: '#2563EB',
                    backgroundColor: primaryGradient,
                    borderWidth: 2.5,
                    fill: true,
                    tension: 0.42,
                    pointRadius: 4,
                    pointHoverRadius: 7,
                    pointBackgroundColor: '#2563EB',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    yAxisID: 'yRevenue',
                },
                {
                    id: 'orders',
                    label: 'Orders',
                    data: data.orders,
                    borderColor: '#22C55E',
                    backgroundColor: ordersGradient,
                    borderWidth: 2.5,
                    fill: true,
                    tension: 0.42,
                    pointRadius: 4,
                    pointHoverRadius: 7,
                    pointBackgroundColor: '#22C55E',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    yAxisID: 'yOrders',
                    hidden: true,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: isDark ? '#1E293B' : '#fff',
                    titleColor: isDark ? '#F1F5F9' : '#111827',
                    bodyColor:  isDark ? '#94A3B8'  : '#6B7280',
                    borderColor: isDark ? '#334155'  : '#E5E7EB',
                    borderWidth: 1,
                    padding: 12,
                    cornerRadius: 10,
                    callbacks: {
                        label(ctx) {
                            if (ctx.dataset.id === 'revenue') {
                                return ` Revenue: $${ctx.parsed.y.toLocaleString()}`;
                            }
                            return ` Orders: ${ctx.parsed.y}`;
                        },
                    },
                },
            },
            scales: {
                x: {
                    grid: { color: gridColor },
                    border: { display: false },
                    ticks: { font: { size: 12 } },
                },
                yRevenue: {
                    position: 'left',
                    grid: { color: gridColor },
                    border: { display: false },
                    ticks: {
                        font: { size: 11 },
                        callback: v => '$' + (v >= 1000 ? (v / 1000).toFixed(0) + 'k' : v),
                    },
                },
                yOrders: {
                    position: 'right',
                    grid: { drawOnChartArea: false },
                    border: { display: false },
                    ticks: { font: { size: 11 } },
                    display: false,
                },
            },
        },
    };

    const salesChart = new Chart(canvas, chartConfig);
    window._dashboardCharts = window._dashboardCharts || [];
    window._dashboardCharts.push(salesChart);

    // Period toggle
    const toggleBtns = $$('#salesChartToggle .period-btn');
    toggleBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            toggleBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const period = btn.getAttribute('data-period');

            salesChart.data.datasets[0].hidden = period === 'orders';
            salesChart.data.datasets[1].hidden = period === 'revenue';
            salesChart.options.scales.yOrders.display = period !== 'revenue';
            salesChart.update('active');
        });
    });
}

/* ─────────────────────────────────────────────────────────────────
   6. CHARTS — Order Status Donut
   ───────────────────────────────────────────────────────────────── */
function initOrderStatusChart() {
    const canvas = $('#orderStatusChart');
    if (!canvas || !window.Chart || !window.DashboardData) return;

    const data = window.DashboardData.orderStatus;

    const donut = new Chart(canvas, {
        type: 'doughnut',
        data: {
            labels: data.labels,
            datasets: [{
                data: data.values,
                backgroundColor: data.colors,
                borderColor: document.documentElement.getAttribute('data-theme') === 'dark' ? '#1E293B' : '#fff',
                borderWidth: 3,
                hoverBorderWidth: 3,
                hoverOffset: 6,
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => ` ${ctx.label}: ${ctx.parsed}%`,
                    },
                    backgroundColor: '#fff',
                    titleColor: '#111827',
                    bodyColor: '#6B7280',
                    borderColor: '#E5E7EB',
                    borderWidth: 1,
                    padding: 10,
                    cornerRadius: 8,
                },
            },
            animation: {
                animateRotate: true,
                duration: 1000,
                easing: 'easeInOutQuart',
            },
        },
        plugins: [
            {
                id: 'centerText',
                afterDraw(chart) {
                    const { ctx, chartArea: { top, bottom, left, right } } = chart;
                    const x = (left + right) / 2;
                    const y = (top + bottom) / 2;
                    const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
                    ctx.save();
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.font = 'bold 22px Inter, sans-serif';
                    ctx.fillStyle = isDark ? '#F1F5F9' : '#111827';
                    ctx.fillText('95', x, y - 8);
                    ctx.font = '500 11px Inter, sans-serif';
                    ctx.fillStyle = isDark ? '#94A3B8' : '#6B7280';
                    ctx.fillText('Orders', x, y + 11);
                    ctx.restore();
                },
            },
        ],
    });

    window._dashboardCharts = window._dashboardCharts || [];
    window._dashboardCharts.push(donut);
}

/* ─────────────────────────────────────────────────────────────────
   7. CHARTS — Revenue by Category
   ───────────────────────────────────────────────────────────────── */
function initRevenueCategoryChart() {
    const canvas = $('#revenueCategoryChart');
    if (!canvas || !window.Chart || !window.DashboardData) return;

    const data = window.DashboardData.revenueByCategory;
    const isDark = document.documentElement.getAttribute('data-theme') === 'dark';

    const barColors = [
        'rgba(37,99,235,0.85)',
        'rgba(6,182,212,0.85)',
        'rgba(5,150,105,0.85)',
        'rgba(245,158,11,0.85)',
        'rgba(124,58,237,0.85)',
        'rgba(239,68,68,0.85)',
    ];

    const barChart = new Chart(canvas, {
        type: 'bar',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Revenue ($)',
                data: data.values,
                backgroundColor: barColors,
                borderRadius: 8,
                borderSkipped: false,
                borderWidth: 0,
                hoverBackgroundColor: barColors.map(c => c.replace('0.85', '1')),
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => ` $${ctx.parsed.y.toLocaleString()}`,
                    },
                    backgroundColor: isDark ? '#1E293B' : '#fff',
                    titleColor: isDark ? '#F1F5F9' : '#111827',
                    bodyColor:  isDark ? '#94A3B8'  : '#6B7280',
                    borderColor: isDark ? '#334155'  : '#E5E7EB',
                    borderWidth: 1,
                    padding: 10,
                    cornerRadius: 8,
                },
            },
            scales: {
                x: {
                    grid: { display: false },
                    border: { display: false },
                    ticks: { font: { size: 12 } },
                },
                y: {
                    grid: { color: isDark ? 'rgba(255,255,255,.06)' : 'rgba(0,0,0,.05)' },
                    border: { display: false },
                    ticks: {
                        font: { size: 11 },
                        callback: v => '$' + (v >= 1000 ? (v / 1000).toFixed(0) + 'k' : v),
                    },
                },
            },
            animation: { duration: 900, easing: 'easeInOutQuart' },
        },
    });

    window._dashboardCharts = window._dashboardCharts || [];
    window._dashboardCharts.push(barChart);
}

/* ─────────────────────────────────────────────────────────────────
   8. GLOBAL SEARCH (keyboard shortcut ⌘K / Ctrl+K)
   ───────────────────────────────────────────────────────────────── */
function initSearch() {
    const searchInput  = $('#globalSearch');
    const mobileBtn    = $('#mobileSearchBtn');
    const mobileBar    = $('#mobileSearchBar');
    const mobileClose  = $('#mobileSearchClose');
    const mobileInput  = $('#mobileSearchInput');

    // Keyboard shortcut
    document.addEventListener('keydown', e => {
        if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
            e.preventDefault();
            if (searchInput) {
                searchInput.focus();
                searchInput.select();
            } else if (mobileBar) {
                mobileBar.classList.add('active');
                mobileInput?.focus();
            }
        }
    });

    // Mobile search toggle
    if (mobileBtn && mobileBar) {
        mobileBtn.addEventListener('click', () => {
            mobileBar.classList.add('active');
            setTimeout(() => mobileInput?.focus(), 50);
        });
    }

    if (mobileClose && mobileBar) {
        mobileClose.addEventListener('click', () => {
            mobileBar.classList.remove('active');
        });
    }
}

/* ─────────────────────────────────────────────────────────────────
   9. LANGUAGE SWITCHER
   ───────────────────────────────────────────────────────────────── */
function initLanguageSwitcher() {
    const items = $$('.lang-item');
    items.forEach(item => {
        item.addEventListener('click', e => {
            e.preventDefault();
            items.forEach(i => {
                i.classList.remove('active');
                i.querySelector('.bi-check2')?.remove();
            });
            item.classList.add('active');
            const check = document.createElement('i');
            check.className = 'bi bi-check2 ms-auto';
            item.appendChild(check);
            // Update flag in toggle button
            const flag = item.querySelector('.flag-emoji')?.textContent;
            const code = item.getAttribute('data-lang')?.toUpperCase();
            const langBtn = $('#langDropdown');
            if (langBtn && flag) {
                langBtn.querySelector('.lang-flag').textContent = flag;
                const codeEl = langBtn.querySelector('.lang-code');
                if (codeEl) codeEl.textContent = code;
            }
        });
    });
}

/* ─────────────────────────────────────────────────────────────────
   10. NOTIFICATION MARK ALL READ
   ───────────────────────────────────────────────────────────────── */
function initNotifications() {
    const markAllBtns = $$('.notification-mark-all');
    markAllBtns.forEach(btn => {
        if (btn.textContent.trim() === 'Mark all as read') {
            btn.addEventListener('click', e => {
                e.preventDefault();
                const dropdown = btn.closest('.notification-dropdown');
                if (!dropdown) return;
                dropdown.querySelectorAll('.notification-item.unread').forEach(item => {
                    item.classList.remove('unread');
                });
                // Update badge
                const badge = document.querySelector('.notif-badge');
                if (badge) {
                    badge.textContent = '0';
                    badge.style.opacity = '0';
                }
            });
        }
    });
}

/* ─────────────────────────────────────────────────────────────────
   11. RIPPLE EFFECT on buttons
   ───────────────────────────────────────────────────────────────── */
function initRipple() {
    function createRipple(event) {
        const btn = event.currentTarget;
        const existing = btn.querySelector('.ripple-wave');
        if (existing) existing.remove();

        const circle  = document.createElement('span');
        const diameter = Math.max(btn.clientWidth, btn.clientHeight);
        const radius   = diameter / 2;
        const rect     = btn.getBoundingClientRect();

        circle.className = 'ripple-wave';
        Object.assign(circle.style, {
            width:    diameter + 'px',
            height:   diameter + 'px',
            left:     (event.clientX - rect.left - radius) + 'px',
            top:      (event.clientY - rect.top - radius) + 'px',
            position: 'absolute',
            borderRadius: '50%',
            background: 'rgba(255,255,255,0.25)',
            transform: 'scale(0)',
            animation: 'rippleAnim 0.55s linear',
            pointerEvents: 'none',
        });

        btn.style.position = 'relative';
        btn.style.overflow = 'hidden';
        btn.appendChild(circle);

        circle.addEventListener('animationend', () => circle.remove());
    }

    // Inject ripple keyframe once
    if (!document.querySelector('#rippleStyle')) {
        const style = document.createElement('style');
        style.id = 'rippleStyle';
        style.textContent = `
            @keyframes rippleAnim {
                to { transform: scale(3); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    }

    $$('.btn-primary-solid, .btn-outline-primary-sm, .quick-action-btn').forEach(btn => {
        btn.addEventListener('click', createRipple);
    });
}

/* ─────────────────────────────────────────────────────────────────
   12. SCROLL ANIMATIONS (Intersection Observer)
   ───────────────────────────────────────────────────────────────── */
function initScrollAnimations() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    $$('.animate-fadeInUp, .animate-fadeIn').forEach(el => {
        el.style.animationPlayState = 'paused';
        observer.observe(el);
    });
}

/* ─────────────────────────────────────────────────────────────────
   13. ACTIVE NAV HIGHLIGHT (for current page)
   ───────────────────────────────────────────────────────────────── */
function initActiveNav() {
    const currentPath = window.location.pathname;
    $$('.nav-item').forEach(item => {
        const href = item.getAttribute('href');
        if (href && href !== '#' && currentPath.startsWith(href)) {
            item.classList.add('active');
        }
    });
}

/* ─────────────────────────────────────────────────────────────────
   14. LOGOUT CONFIRM
   ───────────────────────────────────────────────────────────────── */
function initLogout() {
    // Inject custom modal styles dynamically if they aren't already present
    if (!document.getElementById('custom-logout-styles')) {
        const style = document.createElement('style');
        style.id = 'custom-logout-styles';
        style.textContent = `
            .custom-logout-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                background: rgba(15, 23, 42, 0.4);
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 99999;
                opacity: 0;
                transition: opacity 0.2s ease-out;
            }
            .custom-logout-overlay.show {
                opacity: 1;
            }
            .custom-logout-card {
                background: var(--card-bg, #ffffff);
                border: 1px solid var(--border, rgba(0, 0, 0, 0.08));
                border-radius: var(--radius-lg, 16px);
                box-shadow: var(--shadow-lg, 0 10px 25px -5px rgba(0,0,0,0.1));
                padding: 32px;
                width: 90%;
                max-width: 400px;
                text-align: center;
                transform: scale(0.95);
                transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
            }
            .custom-logout-overlay.show .custom-logout-card {
                transform: scale(1);
            }
            .custom-logout-icon {
                width: 56px;
                height: 56px;
                background: var(--danger-light, #fee2e2);
                color: var(--danger, #ef4444);
                border-radius: var(--radius-full, 9999px);
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 20px;
                font-size: 1.5rem;
            }
            [data-theme="dark"] .custom-logout-icon {
                background: rgba(239, 68, 68, 0.15);
            }
            .custom-logout-title {
                font-size: 1.25rem;
                font-weight: 700;
                color: var(--text, #111827);
                margin-bottom: 8px;
                font-family: var(--font, sans-serif);
            }
            .custom-logout-msg {
                font-size: 0.95rem;
                color: var(--text-secondary, #6b7280);
                margin-bottom: 24px;
                line-height: 1.5;
                font-family: var(--font, sans-serif);
            }
            .custom-logout-actions {
                display: flex;
                gap: 12px;
            }
            .custom-logout-btn {
                flex: 1;
                padding: 10px 16px;
                border-radius: var(--radius-sm, 8px);
                font-weight: 600;
                font-size: 0.9rem;
                cursor: pointer;
                transition: all var(--transition-fast, 0.15s ease);
                font-family: var(--font, sans-serif);
            }
            .custom-logout-btn-cancel {
                background: var(--card-bg, #ffffff);
                border: 1px solid var(--border, #cbd5e1);
                color: var(--text, #334155);
            }
            .custom-logout-btn-cancel:hover {
                background: var(--border-light, #f8fafc);
                border-color: var(--text-secondary, #94a3b8);
            }
            .custom-logout-btn-confirm {
                background: linear-gradient(135deg, var(--danger, #ef4444) 0%, #dc2626 100%);
                border: none;
                color: #ffffff;
                box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
            }
            .custom-logout-btn-confirm:hover {
                transform: translateY(-1px);
                box-shadow: 0 6px 16px rgba(239, 68, 68, 0.3);
            }
        `;
        document.head.appendChild(style);
    }

    const logoutLinks = $$('#nav-logout, .profile-logout');
    logoutLinks.forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();
            
            // Create modal elements
            const overlay = document.createElement('div');
            overlay.className = 'custom-logout-overlay';
            
            overlay.innerHTML = `
                <div class="custom-logout-card">
                    <div class="custom-logout-icon">
                        <i class="bi bi-box-arrow-left"></i>
                    </div>
                    <h3 class="custom-logout-title">Sign Out</h3>
                    <p class="custom-logout-msg">Are you sure you want to sign out of your account?</p>
                    <div class="custom-logout-actions">
                        <button class="custom-logout-btn custom-logout-btn-cancel" id="confirm-logout-cancel">Cancel</button>
                        <button class="custom-logout-btn custom-logout-btn-confirm" id="confirm-logout-ok">Sign Out</button>
                    </div>
                </div>
            `;
            
            document.body.appendChild(overlay);
            
            // Trigger transition
            setTimeout(() => {
                overlay.classList.add('show');
            }, 10);
            
            // Event Listeners
            const btnCancel = overlay.querySelector('#confirm-logout-cancel');
            const btnConfirm = overlay.querySelector('#confirm-logout-ok');
            
            const closeModal = () => {
                overlay.classList.remove('show');
                setTimeout(() => {
                    overlay.remove();
                }, 200);
            };
            
            btnCancel.addEventListener('click', closeModal);
            overlay.addEventListener('click', e => {
                if (e.target === overlay) closeModal();
            });
            
            btnConfirm.addEventListener('click', () => {
                closeModal();
                const form = document.getElementById('logout-form');
                if (form) {
                    form.submit();
                } else {
                    window.location.href = '/';
                }
            });
        });
    });
}

/* ─────────────────────────────────────────────────────────────────
   15. TABLE SORT (client-side, simple)
   ───────────────────────────────────────────────────────────────── */
function initTableSort() {
    $$('.admin-table').forEach(table => {
        const headers = $$('thead th', table);
        headers.forEach((th, colIdx) => {
            th.style.cursor = 'pointer';
            th.title = 'Click to sort';
            let asc = true;

            th.addEventListener('click', () => {
                const tbody = table.querySelector('tbody');
                if (!tbody) return;
                const rows = [...tbody.querySelectorAll('tr')];

                rows.sort((a, b) => {
                    const aText = a.cells[colIdx]?.textContent.trim() || '';
                    const bText = b.cells[colIdx]?.textContent.trim() || '';
                    const aNum  = parseFloat(aText.replace(/[^0-9.-]/g, ''));
                    const bNum  = parseFloat(bText.replace(/[^0-9.-]/g, ''));

                    if (!isNaN(aNum) && !isNaN(bNum)) {
                        return asc ? aNum - bNum : bNum - aNum;
                    }
                    return asc
                        ? aText.localeCompare(bText)
                        : bText.localeCompare(aText);
                });

                rows.forEach(r => tbody.appendChild(r));
                asc = !asc;

                headers.forEach(h => {
                    h.classList.remove('sort-asc', 'sort-desc');
                    const sortIcon = h.querySelector('.sort-icon');
                    if (sortIcon) sortIcon.remove();
                });

                const icon = document.createElement('i');
                icon.className = `sort-icon bi bi-caret-${asc ? 'down' : 'up'}-fill ms-1`;
                icon.style.fontSize = '0.65rem';
                th.appendChild(icon);
                th.classList.add(asc ? 'sort-desc' : 'sort-asc');
            });
        });
    });
}

/* ─────────────────────────────────────────────────────────────────
   INITIALISE ALL
   ───────────────────────────────────────────────────────────────── */
onReady(() => {
    initDarkMode();         // Must run first (sets theme before charts)
    initSidebar();
    initGreetingAndClock();
    initCounters();
    initSearch();
    initLanguageSwitcher();
    initNotifications();
    initRipple();
    initLogout();
    initTableSort();
    initScrollAnimations();
    initActiveNav();

    // Charts — delay to allow CSS animations to settle
    requestAnimationFrame(() => {
        setTimeout(() => {
            initMonthlySalesChart();
            initOrderStatusChart();
            initRevenueCategoryChart();
        }, 200);
    });
});
