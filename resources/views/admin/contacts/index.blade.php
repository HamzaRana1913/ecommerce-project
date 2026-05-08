@extends('layouts.admin')
@section('title', 'Contact Messages')
@section('page_title', 'Contact Messages')

@section('admin_content')
<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title"><i class="fas fa-envelope" style="color:var(--gold);margin-right:0.5rem"></i>All Contact Messages</div>
    </div>
    <div class="table-card-body">
        <table class="table data-table table-hover" id="contactsTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts ?? [] as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td><strong>{{ $contact->name }}</strong></td>
                    <td><a href="mailto:{{ $contact->email }}" style="color:var(--gold)">{{ $contact->email }}</a></td>
                    <td>{{ $contact->phone ?? '—' }}</td>
                    <td><span class="badge bg-secondary">{{ ucwords(str_replace('_',' ',$contact->subject)) }}</span></td>
                    <td style="max-width:250px">
                        <div style="max-height:60px;overflow:hidden;font-size:0.85rem;color:var(--text-muted)">{{ Str::limit($contact->message, 80) }}</div>
                    </td>
                    <td>{{ $contact->created_at->format('M d, Y H:i') ?? '—' }}</td>
                    <td>
                        <span class="badge-status {{ $contact->is_read ? 'badge-completed' : 'badge-pending' }}">
                            {{ $contact->is_read ? 'Read' : 'New' }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
