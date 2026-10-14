@props(['status'])
@php
    $color = [
        'pending' => 'bg-amber-100 text-amber-800',
        'approved' => 'bg-green-100 text-green-800',
        'closed' => 'bg-slate-200 text-slate-700',
        'new' => 'bg-blue-100 text-blue-800',
        'viewed' => 'bg-slate-100 text-slate-700',
        'interview' => 'bg-violet-100 text-violet-800',
        'rejected' => 'bg-red-100 text-red-800',
        'accepted' => 'bg-green-100 text-green-800',
    ];
    $label = [
        'pending' => 'Chờ duyệt', 'approved' => 'Đã duyệt', 'closed' => 'Đã đóng',
        'new' => 'Mới', 'viewed' => 'Đã xem', 'interview' => 'Phỏng vấn',
        'rejected' => 'Từ chối', 'accepted' => 'Đã nhận',
    ];
@endphp
<span class="rounded-full px-2.5 py-1 text-xs font-medium {{ $color[$status] ?? 'bg-slate-100 text-slate-700' }}">
    {{ $label[$status] ?? $status }}
</span>