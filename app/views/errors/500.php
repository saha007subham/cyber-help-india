<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Error — Cyber Help India</title>
    <style>
        :root {
            --bg-color: #0b1120;
            --card-bg: #1e293b;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --accent: #38bdf8;
            --danger: #ef4444;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .error-card {
            background-color: var(--card-bg);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 40px;
            max-width: 500px;
            text-align: center;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5);
        }
        .error-badge {
            display: inline-block;
            background: rgba(239, 68, 68, 0.15);
            color: var(--danger);
            padding: 6px 14px;
            border-radius: 9999px;
            font-weight: 700;
            font-size: 0.875rem;
            margin-bottom: 20px;
        }
        h1 {
            font-size: 1.75rem;
            margin: 0 0 12px 0;
        }
        p {
            color: var(--text-muted);
            line-height: 1.6;
            margin: 0 0 24px 0;
        }
        a.btn {
            display: inline-block;
            background: #2563eb;
            color: #ffffff;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.2s ease;
        }
        a.btn:hover {
            background: #1d4ed8;
        }
    </style>
</head>
<body>
    <div class="error-card">
        <span class="error-badge">Status 500</span>
        <h1>Something went wrong</h1>
        <p>An unexpected server error occurred. Our engineering team has been notified and is working to resolve it.</p>
        <a href="/" class="btn">&larr; Return to Homepage</a>
    </div>
</body>
</html>
