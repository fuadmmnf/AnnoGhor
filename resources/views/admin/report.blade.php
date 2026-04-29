@extends('layouts.admin')

@section('title', 'Reports')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">

                <!-- Header -->
                <div class="flex items-center justify-between flex-wrap gap20 mb-30">
                    <div>
                        <h3 class="mb-4">Reports</h3>
                        <p class="text-tiny text-gray-500">
                            Generate and download system reports
                        </p>
                    </div>

                    <ul class="breadcrumbs flex items-center gap10">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">
                                <div class="text-tiny">Dashboard</div>
                            </a>
                        </li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li>
                            <div class="text-tiny">Reports</div>
                        </li>
                    </ul>
                </div>

                <!-- Report Cards -->
                <div class="report-grid">

                    <!-- Stock Report -->
                    <div class="wg-box report-card">
                        <div class="report-icon bg-blue">
                            📦
                        </div>

                        <div class="report-content">
                            <h4>Stock Report</h4>
                            <p class="text-tiny">
                                View current inventory and available stock
                            </p>

                            <div class="report-actions">
                                <a href="{{ route('admin.report.stock', ['mode' => 'preview']) }}" target="_blank"
                                    class="tf-button style-2 w-full">
                                    Preview
                                </a>

                                <a href="{{ route('admin.report.stock', ['mode' => 'download']) }}"
                                    class="tf-button style-1 w-full">
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Sell Report -->
                    <div class="wg-box report-card">
                        <div class="report-icon bg-green">
                            💰
                        </div>

                        <div class="report-content">
                            <h4>Sell Report</h4>
                            <p class="text-tiny">
                                Product-wise sales & revenue summary
                            </p>

                            <!-- Dropdown -->
                            <select id="sellRange" class="tf-input mb-12 w-full" onchange="updateSellLinks(this.value)">
                                <option value="today">Today</option>
                                <option value="week">Last 7 Days</option>
                                <option value="month">Last 1 Month</option>
                            </select>

                            <div class="report-actions">
                                <a id="sellPreview"
                                    href="{{ route('admin.report.sell', ['mode' => 'preview', 'range' => 'today']) }}"
                                    target="_blank" class="tf-button style-2 w-full">
                                    Preview
                                </a>

                                <a id="sellDownload"
                                    href="{{ route('admin.report.sell', ['mode' => 'download', 'range' => 'today']) }}"
                                    class="tf-button style-1 w-full">
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Restock Report -->
                    <div class="wg-box report-card">
                        <div class="report-icon bg-blue">
                            📦
                        </div>

                        <div class="report-content">
                            <h4>Restock Report</h4>
                            <p class="text-tiny">
                                Product-wise restock history summary
                            </p>

                            <!-- Dropdown -->
                            <select id="restockRange" class="tf-input mb-12 w-full"
                                onchange="updateRestockLinks(this.value)">
                                <option value="today">Today</option>
                                <option value="week">Last 7 Days</option>
                                <option value="month">Last 1 Month</option>
                            </select>

                            <div class="report-actions">
                                <a id="restockPreview" href="{{ route('admin.report.restock') }}?mode=preview&range=today"
                                    target="_blank" class="tf-button style-2 w-full">
                                    Preview
                                </a>

                                <a id="restockDownload" href="{{ route('admin.report.restock') }}?mode=download&range=today"
                                    class="tf-button style-1 w-full">
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>

    <!-- JS -->
    <script>
        function updateSellLinks(range) {
            updateReportLinks(
                "{{ route('admin.report.sell') }}",
                'sellPreview',
                'sellDownload',
                range
            );
        }

        function updateRestockLinks(range) {
            updateReportLinks(
                "{{ route('admin.report.restock') }}",
                'restockPreview',
                'restockDownload',
                range
            );
        }

        function updateReportLinks(baseUrl, previewId, downloadId, range) {
            const preview = document.getElementById(previewId);
            const download = document.getElementById(downloadId);

            if (!preview || !download) return;

            preview.href = `${baseUrl}?mode=preview&range=${range}`;
            download.href = `${baseUrl}?mode=download&range=${range}`;
        }
    </script>


    <style>
        /* ===== GRID ===== */
        .report-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        /* Medium screens */
        @media (min-width: 768px) {
            .report-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Large screens */
        @media (min-width: 1200px) {
            .report-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* ===== CARD ===== */
        .report-card {
            display: flex;
            gap: 16px;
            padding: 18px;
            border-radius: 12px;
            transition: all 0.25s ease;
        }

        .report-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08);
        }

        /* ===== ICON ===== */
        .report-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #fff;
        }

        .bg-blue {
            background: linear-gradient(135deg, #4f8cff, #3b6cff);
        }

        .bg-green {
            background: linear-gradient(135deg, #22c55e, #16a34a);
        }

        /* ===== CONTENT ===== */
        .report-content {
            display: flex;
            flex-direction: column;
            gap: 10px;
            flex: 1;
        }

        .report-content h4 {
            margin-bottom: 4px;
        }

        .report-content p {
            margin-bottom: 14px;
        }

        /* ===== ACTIONS ===== */
        .report-actions {
            margin-top: auto;
            display: flex;
            gap: 10px;
        }
    </style>
@endsection
