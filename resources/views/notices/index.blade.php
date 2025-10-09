<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>All Notices</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4">All Notices</h2>
        @foreach($announcements as $n)
            <div class="border rounded p-3 bg-white mb-3">
                <div class="d-flex justify-content-between">
                    <strong>{{ $n->notice }}</strong>
                    <small>{{ $n->created_at ? \Carbon\Carbon::parse($n->created_at)->format('d M Y') : '' }}</small>
                </div>
                @if($n->type)<span class="badge bg-secondary mt-2">{{ $n->type }}</span>@endif
            </div>
        @endforeach

        {{ $announcements->links() }}
    </div>
</body>

</html>