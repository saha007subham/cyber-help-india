<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Error — Debug Mode</title>
    <style>
        :root {
            --bg: #0f172a;
            --surface: #1e293b;
            --border: #334155;
            --danger: #f43f5e;
            --accent: #38bdf8;
            --text: #f8fafc;
            --text-dim: #94a3b8;
            --code-bg: #0b0f19;
        }
        body {
            margin: 0;
            padding: 24px;
            background: var(--bg);
            color: var(--text);
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            line-height: 1.6;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
        }
        .header {
            background: rgba(244, 63, 94, 0.12);
            border: 1px solid rgba(244, 63, 94, 0.4);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 24px;
        }
        .error-type {
            color: var(--danger);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
        }
        .error-message {
            font-size: 1.4rem;
            font-weight: 600;
            margin: 8px 0;
            color: #ffffff;
        }
        .error-location {
            color: var(--accent);
            font-size: 0.95rem;
            word-break: break-all;
        }
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 24px;
        }
        .card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--accent);
            margin: 0 0 16px 0;
        }
        pre {
            background: var(--code-bg);
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 16px;
            overflow-x: auto;
            font-size: 0.85rem;
            color: #e2e8f0;
            margin: 0;
        }
        .notice {
            background: #1e1b4b;
            border: 1px solid #4338ca;
            border-radius: 6px;
            padding: 12px 16px;
            font-size: 0.85rem;
            color: #c7d2fe;
            margin-top: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="error-type"><?= htmlspecialchars(get_class($exception ?? new Exception())) ?></div>
            <div class="error-message"><?= htmlspecialchars($exception->getMessage() ?? 'Unknown error') ?></div>
            <div class="error-location">
                <?= htmlspecialchars($exception->getFile() ?? '') ?> : Line <?= (int)($exception->getLine() ?? 0) ?>
            </div>
        </div>

        <div class="card">
            <h3 class="card-title">Stack Trace</h3>
            <pre><?= htmlspecialchars($exception->getTraceAsString() ?? 'No trace available.') ?></pre>
        </div>

        <div class="notice">
            &#9888;&#65039; <strong>Debug Mode Active (APP_DEBUG=true)</strong>. Detailed error traces are only visible in local/development environments. Set <code>APP_DEBUG=false</code> in <code>.env</code> for production environments.
        </div>
    </div>
</body>
</html>
